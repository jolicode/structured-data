<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\Vocabularies\Generators\Google\PrettyPrinter;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Filesystem;
use PhpParser\BuilderFactory;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt;

/**
 * Pre-builds the schema.org context, as PHP and as JSON, by running the Context
 * Processing algorithm once at generation time.
 *
 * This way the runtime can skip context processing entirely for schema.org.
 */
class StaticSchemaOrgContextGenerator
{
    public function __construct(
        private readonly BuilderFactory $factory = new BuilderFactory(),
        private readonly PrettyPrinter $printer = new PrettyPrinter(),
        private readonly Filesystem $filesystem = new Filesystem(),
    ) {
    }

    /**
     * Uses the Context Processing algorithm on schema.org definitions and pre-build a PHP and a JSON version of it.
     * This way, we can completely skip the context processing (which is slooow) for schema.org.
     */
    public function generate(): void
    {
        $schemaOrgDefinitions = json_decode(
            $this->filesystem->getSchemaOrgTypesDefinition(),
        );

        $localContext = (object) [
            '@vocab' => 'http://schema.org/',
            '@version' => 1.1,
            'id' => '@id',
            'type' => '@type',
        ];

        foreach ((array) $schemaOrgDefinitions->{'@context'} as $term => $mapping) {
            if (\is_string($mapping)) {
                $localContext->{$term} = $mapping;
            }
        }

        foreach ((array) $schemaOrgDefinitions->{'@graph'} as $entry) {
            if (!\is_object($entry) || !isset($entry->{'@id'}) || !\is_string($entry->{'@id'})) {
                continue;
            }

            if (!str_starts_with($entry->{'@id'}, 'schema:')) {
                continue;
            }

            $term = substr($entry->{'@id'}, 7);

            if ('' === $term || isset($localContext->{$term})) {
                continue;
            }

            $localContext->{$term} = 'http://schema.org/' . $term;
        }

        $processer = new ContextProcessor();
        $remoteContexts = [];
        $context = $processer->processContext(new Context(), $localContext, null, $remoteContexts, false, true, true);

        $outputDirectory = $this->filesystem::SCHEMA_ORG_DIR . '/context';

        if (!is_dir($outputDirectory) && !mkdir($outputDirectory, 0777, true) && !is_dir($outputDirectory)) {
            throw new \RuntimeException(\sprintf('Could not create output directory "%s".', $outputDirectory));
        }

        $jsonOutputFile = $outputDirectory . '/schemaorg-context.jsonld';
        $staticOutputFile = $outputDirectory . '/schemaorg-static-context.php';

        $jsonContextDocument = [
            '@context' => $localContext,
        ];

        file_put_contents(
            $jsonOutputFile,
            (string) json_encode($jsonContextDocument, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES) . "\n",
        );

        $terms = [];

        foreach ($context->termDefinitions as $term => $termDefinition) {
            $terms[] = new ArrayItem(
                new Array_([
                    new ArrayItem($this->factory->val($termDefinition->iriMapping)),
                    new ArrayItem($this->factory->val($termDefinition->prefixFlag)),
                    new ArrayItem($this->factory->val($termDefinition->typeMapping)),
                ], ['kind' => Array_::KIND_SHORT]),
                $this->factory->val($term),
            );
        }

        $staticContext = new Array_([
            new ArrayItem($this->factory->val($context->vocabularyMapping), $this->factory->val('vocab')),
            new ArrayItem(new Array_($terms, ['kind' => Array_::KIND_SHORT]), $this->factory->val('terms')),
        ], ['kind' => Array_::KIND_SHORT]);

        $staticPhp = "<?php\n\n" . StaticFileGenerator::FILE_HEADER . "\n\n"
            . $this->printer->prettyPrint([new Stmt\Return_($staticContext)]) . "\n";

        file_put_contents($staticOutputFile, $staticPhp);
    }
}
