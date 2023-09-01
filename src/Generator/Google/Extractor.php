<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google;

use Jolicode\JsonLd\Generator\Google\Objects\Property;
use Jolicode\JsonLd\Generator\Google\Objects\Type;
use Jolicode\JsonLd\Generator\SchemaOrg\Objects\ClassesContainer;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\String\Slugger\AsciiSlugger;

class Extractor
{
    public const SEVERITY_RECOMMENDED = 'recommended';
    public const SEVERITY_REQUIRED = 'required';

    private const GOOGLE_DOMAIN = 'https://developers.google.com';
    private const TYPES_SOURCE_URL = self::GOOGLE_DOMAIN . '/search/docs/appearance/structured-data';
    private const CACHE_DIRECTORY = __DIR__ . '/../../../var/cache/google/';

    private const SKIPPED_LINKS = [
        'https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data',
        'https://developers.google.com/search/docs/appearance/structured-data/sd-policies',
        'https://developers.google.com/search/docs/appearance/structured-data/generate-structured-data-with-javascript',
        'https://developers.google.com/search/docs/appearance/structured-data/search-gallery',
        'https://developers.google.com/search/docs/appearance/structured-data/enriched-search-results',
    ];

    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly AsciiSlugger $slugger = new AsciiSlugger(),
        private readonly Finder $finder = new Finder(),

        private ?Type $currentType = null,
        private ?array $propertyToUpdate = null,
        private bool $reachedEndOfDefintions = false,

        /**
         * @var array<string, Type>
         */
        private array $extractedTypes = [],
    ) {
    }

    public function extractClasses(bool $refresh): ClassesContainer
    {
        $client = HttpClient::create();

        if ($refresh || !$this->filesystem->exists(self::CACHE_DIRECTORY)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::TYPES_SOURCE_URL . '/search-gallery');

            $crawler = new Crawler($response->getContent());
            $navLinks = $crawler->filter('li.devsite-nav-expandable ul.devsite-nav-section a.devsite-nav-title')->extract(['href']);
            $foundLinks = [];

            foreach ($navLinks as $link) {
                // fix relative path
                if (false === filter_var($link, \FILTER_VALIDATE_URL)) {
                    $link = self::GOOGLE_DOMAIN . $link;
                }

                if (str_starts_with($link, self::TYPES_SOURCE_URL) && !\in_array($link, self::SKIPPED_LINKS, true)) {
                    $foundLinks[] = $link;
                }
            }

            foreach ($foundLinks as $typeLink) {
                $fileName = explode('/', $typeLink);
                $fileName = end($fileName);

                $this->filesystem->dumpFile(
                    sprintf('%s%s.html', self::CACHE_DIRECTORY, $fileName),
                    $client->request('GET', $typeLink)->getContent()
                );
            }
        }

        // foreach ($this->finder->files()->in(self::CACHE_DIRECTORY) as $file) {
        //     dump(fileName: $file->getFilename());
        //     $this->extractTypes($file->getFilename(), file_get_contents($file->getRealPath()));
        // }

        $this->extractTypes('movie.html', file_get_contents('/home/hedic/Dev/JoliCode/json-ld-projects/json-ld/var/cache/google/movie.html'));

        dump($this->extractedTypes);

        return $this->createContainer();
    }

    private function extractTypes(string $fileName, string $document): void
    {
        $crawler = new Crawler($document);

        $definitions = $crawler->filter('[data-text*="Structured data type definitions"]');

        if ($definitions->count()) {
            $definitions
                ->nextAll()
                ->each(function (Crawler $node) use ($fileName) {
                    match ($node->nodeName()) {
                        'h2' => $this->endCrawling($node),
                        'h3' => $this->initializeType($node, $fileName),
                        'h4' => $this->initializeSubtype($node, $fileName),
                        'table' => $this->extractProperties($node, $this->getTableSeverity($node), $fileName),
                        default => null,
                    };
                });

            $this->pushCurrentType();
            $this->currentType = null;
            $this->reachedEndOfDefintions = false;
        }
    }

    private function generateGoogleLink(string $fileName, string $anchor = null): string
    {
        $typeLink = str_replace('.html', '', $fileName);
        $typeLink = sprintf('%s/%s', self::TYPES_SOURCE_URL, $typeLink);

        if ($anchor) {
            return sprintf('%s#%s', $typeLink, $anchor);
        }

        return $typeLink;
    }

    private function pushCurrentType(): void
    {
        if (
            $this->currentType
            && !$this->currentType->isEmpty()
            && !$this->currentType->isASubtype
        ) {
            $this->extractedTypes[] = $this->currentType;
        }

        if ($this->currentType?->isASubtype) {
            $this->extractedTypes[] = $this->currentType->parentType;
        }
    }

    private function endCrawling(Crawler $node): void
    {
        dump($node->text());

        if ('Troubleshooting' === $node->text()) {
            $this->reachedEndOfDefintions = true;
        }
    }

    private function initializeType(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefintions) {
            return;
        }

        $this->propertyToUpdate = null;
        $name = $node->text();

        // Regular pages use some `.` to mark the nested properties expected values.
        // But the book page also uses new tables with `()` in the title to indicate the property.
        // And it still uses some `.` as well.
        // This causes quite a lot of issues and chaos...
        if (preg_match('/\((.+)\)/', $name, $matches)) {
            if (!str_contains(strtolower($name), 'beta')) {
                $this->definePropertyToUpdate($name, $matches[1]);
            }
        } else {
            // Again the book page. Some examples are written inside h3 tags.
            if ($this->shouldSkipTitle($name)) {
                return;
            }

            $this->pushCurrentType();

            // The book page adds a useless `entity` keyword. Other types are written in PascalCase so its fine.
            // TODO: not true!
            // On https://developers.google.com/search/docs/appearance/structured-data/learning-video
            // There are titles with spaces and even brackets... We have to handle this as well.
            $name = explode(' ', $name);

            $this->currentType = new Type();
            $this->currentType->name = $name[0];
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));
        }
    }

    private function initializeTypeWithNoTitle(string $fileName): bool
    {
        $typesWithMissingTitle = [
            'image-license-metadata.html' => 'ImageObject',
        ];

        if (\array_key_exists($fileName, $typesWithMissingTitle)) {
            $this->pushCurrentType();

            $this->currentType = new Type();
            $this->currentType->name = $typesWithMissingTitle[$fileName];
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName);

            return true;
        }

        return false;
    }

    private function shouldSkipTitle(string $name): bool
    {
        $wrongTitles = [
            'Example BorrowAction Book feed JSON file',
            'Example ReadAction Book feed JSON file',
            'Example LibrarySystem feed JSON file',
            'IPTC photo metadata',
        ];

        return \in_array($name, $wrongTitles, true);
    }

    private function definePropertyToUpdate(string $fullTitle, string $targetProperty): void
    {
        $targetValues = preg_replace('/\s\((.+)\)/', '', $fullTitle);
        $targetValues = explode(' or ', $targetValues);

        $this->propertyToUpdate = [$targetProperty, $targetValues];
    }

    private function initializeSubtype(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefintions) {
            return;
        }

        if (str_contains($node->text(), 'Beta')) {
            return;
        }

        $this->propertyToUpdate = null;
        $name = $node->text();
        preg_match('/\((.+)\)/', $name, $matches);

        if (!\array_key_exists(1, $matches)) {
            $this->initializeType($node, $fileName);

            return;
        }

        $subType = $matches[1];

        $subType = new Type(
            name: $subType,
            isASubtype: true,
            parentType: $this->currentType->isASubtype ? $this->currentType->parentType : $this->currentType,
            documentationUrl: $this->generateGoogleLink($fileName, $node->attr('id')),
        );

        if ($this->currentType->isASubtype) {
            $this->currentType->parentType->subTypes[] = $subType;
        } else {
            $this->currentType->subTypes[] = $subType;
        }

        $this->currentType = $subType;
    }

    private function getTableSeverity(Crawler $table): string|false
    {
        $severity = $table->filter('tr > th')->text();

        if (str_contains(strtolower($severity), 'required')) {
            return self::SEVERITY_REQUIRED;
        }

        if (str_contains(strtolower($severity), 'recommended')) {
            return self::SEVERITY_RECOMMENDED;
        }

        return false;
    }

    private function extractProperties(Crawler $table, string $severity, string $fileName): void
    {
        if ($this->reachedEndOfDefintions) {
            return;
        }

        if (!$this->currentType) {
            if (!$this->initializeTypeWithNoTitle($fileName)) {
                return;
            }
        }

        if (!$severity) {
            return;
        }

        $head = $table->filter('tr > th')->text();
        $isABetaTable = false;

        if (str_contains(strtolower($head), '(beta)')) {
            $isABetaTable = true;
        }

        $table
            ->filter('tbody > tr')
            ->each(function (Crawler $row) use ($isABetaTable, $severity) {
                $keyNode = $row->filter('td')->getNode(0);
                $valueNode = $row->filter('td')->getNode(1);

                if (null === $keyNode || null === $valueNode) {
                    return;
                }

                $this->extractKeyCell($keyNode, $isABetaTable, $severity);
                $this->extractValueCell($valueNode, $isABetaTable, $severity);
            });

        $this->currentType->cleanUpProperties($severity);
    }

    private function extractKeyCell(\DOMNode $keyNode, bool $isABetaTable, string $severity): void
    {
        $codeEntries = array_filter(
            iterator_to_array($keyNode->childNodes),
            fn (\DOMNode $node) => 'code' === $node->nodeName,
        );

        if (1 === \count($codeEntries)) {
            $this->handleNewProperty($codeEntries[array_key_first($codeEntries)]->nodeValue, $severity, $isABetaTable);
        }

        if (1 < \count($codeEntries)) {
            $atLeastOneOf = array_map(
                fn (\DOMNode $node) => new Property($node->nodeValue),
                $codeEntries,
            );

            $this->handleNewProperty('atLeastOneOf', $severity, $isABetaTable, $atLeastOneOf);
        }
    }

    private function extractValueCell(\DOMNode $keyNode, bool $isABetaTable, string $severity): void
    {
        $codeEntries = array_map(
            function (\DOMNode $node) {
                if ('p' === $node->nodeName) {
                    foreach (iterator_to_array($node->childNodes) as $child) {
                        if ('code' === $child->nodeName) {
                            return $child;
                        }
                    }
                }

                if ('code' === $node->nodeName) {
                    return $node;
                }
            },
            iterator_to_array($keyNode->childNodes),
        );

        foreach ($codeEntries as $codeEntry) {
            dump($codeEntry->nodeName, $codeEntry->nodeValue);
        }

        /**
         * @var array<\DOMNode> $codeEntries
         */
        foreach (array_filter($codeEntries) as $codeTag) {
            foreach (iterator_to_array($codeTag->childNodes) as $nodeEntry) {
                // dump($nodeEntry->nodeValue);

                if ('a' === $nodeEntry->nodeName) {
                    $this->handleValue($nodeEntry, $nodeEntry->attributes, $isABetaTable);
                }

                // Usually, the `a` tag is wrapped around the `code` tag. However, for the book page, it is the contrary... WEB SCRAPPING !
                if (
                    '#text' === $nodeEntry->nodeName
                    && 'a' === $codeTag->parentNode->nodeName
                ) {
                    $this->handleValue($nodeEntry, $codeTag->parentNode->attributes, $isABetaTable);
                }
            }
        }
    }

    /**
     * @param array<Property> $atLeastOneOf sometimes, Google requires at least one of a set of properties to be present
     */
    private function handleNewProperty(string $name, string $severity, bool $isABetaTable, array $atLeastOneOf = []): void
    {
        if ($this->propertyToUpdate) {
            if ($this->currentType->isASubtype) {
                foreach ($this->currentType->parentType->subTypes as $subType) {
                    $subType->addPropertyProperty($name, $this->propertyToUpdate, $severity, $isABetaTable);
                }
            } else {
                $this->currentType->addPropertyProperty($name, $this->propertyToUpdate, $severity, $isABetaTable);
            }
        } else {
            $this->currentType->initProperty($name, $severity, $isABetaTable, $atLeastOneOf);
        }
    }

    private function handleValue(\DOMNode $nodeEntry, \DOMNamedNodeMap $attributes, bool $isABetaTable): void
    {
        foreach ($attributes as $attr) {
            if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                $this->currentType->pushProperty($nodeEntry->nodeValue, $isABetaTable);

                break;
            }
        }
    }

    private function createContainer(): ClassesContainer
    {
        $container = new ClassesContainer();

        // foreach ($this->finder->files()->in(self::CACHE_DIRECTORY) as $googleType) {
        //     dd($googleType);
        // }

        return $container;
    }
}
