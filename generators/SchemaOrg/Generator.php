<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg;

use JoliCode\StructuredData\Vocabularies\Generators\GeneratorInterface;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Objects\ClassesContainer;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Objects\EnumerationMember;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Objects\Property;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Objects\Type;
use JoliCode\StructuredData\Vocabularies\Generators\StaticFileGenerator;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;

readonly class Generator implements GeneratorInterface
{
    public const NAMESPACE_TYPE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type';
    public const NAMESPACE_PROPERTY = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Property';
    public const NAMESPACE_ENUMERATION_MEMBER = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\EnumerationMember';

    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
        private Standard $printer = new Standard(),
        private ElementNodeBuilder $elementNodeBuilder = new ElementNodeBuilder(),
    ) {
    }

    public static function getName(): string
    {
        return 'schema.org';
    }

    public function generate(?SymfonyStyle $io = null): void
    {
        $extractor = new Extractor();
        $this->generateClasses($extractor->extractClasses());
        (new StaticFileGenerator())->generate();
    }

    public function generateExamples(string $schemaOrgExamples): void
    {
        $crawler = new Crawler($schemaOrgExamples);
        $crawler
            ->filter('script[type^=application]')
            ->each(function (Crawler $example, $i) {
                $example = trim($example->outerHtml());
                $this->saveExample('https-schema-org', $example);
            });
    }

    private function generateClasses(ClassesContainer $container): void
    {
        foreach ($container->getAllElements() as $element) {
            $type = match ($element::class) {
                Type::class => 'Type',
                Property::class => 'Property',
                EnumerationMember::class => 'EnumerationMember',
                default => throw new \RuntimeException(\sprintf('Unknown class %s', $element::class)),
            };

            $this->filesystem->saveSchemaOrgClass(
                $type,
                $element->className,
                $this->printer->prettyPrintFile([$this->elementNodeBuilder->generateElement($element)]),
            );
        }
    }

    private function saveExample(string $prefix, string $example): void
    {
        if (preg_match('/\<script type\=\"application\/ld\+json\"\>(.*)\<\/script\>/s', $example, $matches)) {
            $content = $this->removeComments($matches[1]);
            $this->filesystem->saveSchemaOrgExample($prefix, $content);
        } elseif ($this->maybeJsonString($example)) {
            $this->filesystem->saveSchemaOrgExample($prefix, $example);
        }
    }

    private function removeComments(string $example): string
    {
        $example = explode("\n", $example);

        foreach ($example as $line => $content) {
            if (str_starts_with(trim($content), '//')) {
                unset($example[$line]);
            }
        }

        return trim(implode("\n", $example));
    }

    private function maybeJsonString(string $body): bool
    {
        return \in_array(substr(trim($body), 0, 1), ['[', '{'], true);
    }
}
