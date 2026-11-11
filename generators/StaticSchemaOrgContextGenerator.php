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
     * Uses the Context Processing algorithm on the official schema.org context and pre-build a PHP and a JSON version of it.
     * This way, we can completely skip the context processing (which is slooow) for schema.org.
     *
     * The context is the one schema.org publishes with each release, which is what a JSON-LD
     * processor gets when it resolves "@context": "https://schema.org". It is used as is
     * rather than rebuilt from the definition file: the prefixes the definition file
     * declares for its own use can clash with schema.org terms (since 30.1, a "geo" prefix
     * for GeoSPARQL shadows the "geo" property) and do not match the published ones (its
     * "schema" prefix is https, the published one is http).
     */
    public function generate(): void
    {
        $officialContext = json_decode($this->filesystem->getSchemaOrgContext());

        if (!\is_object($officialContext) || !isset($officialContext->{'@context'}) || !\is_object($officialContext->{'@context'})) {
            throw new \RuntimeException('The schema.org context file does not hold a "@context" object.');
        }

        $localContext = $officialContext->{'@context'};

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
