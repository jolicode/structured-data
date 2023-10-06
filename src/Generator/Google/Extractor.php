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
        'https://developers.google.com/search/docs/appearance/structured-data/carousel',
    ];

    public function __construct(
        private readonly Filesystem $filesystem,
        private readonly AsciiSlugger $slugger = new AsciiSlugger(),
        private readonly Finder $finder = new Finder(),

        private ?Type $currentType = null,
        private ?array $propertyToUpdate = null,
        private bool $reachedEndOfDefinitions = false,

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
            if ($this->filesystem->exists(self::CACHE_DIRECTORY)) {
                $this->filesystem->remove(self::CACHE_DIRECTORY);
            }

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

            sort($foundLinks);

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
        //     dump($file->getFilename());
        //     $this->extractTypes($file->getFilename(), file_get_contents($file->getRealPath()));
        // }

        $this->extractTypes('movie.html', file_get_contents('/home/hedic/Dev/JoliCode/json-ld-projects/json-ld/var/cache/google/breadcrumb.html'));

        dump($this->extractedTypes);

        // foreach ($this->extractedTypes as $type) {
        //     if ($type->isCarouselEligible) {
        //         dump($type);
        //     }
        // }

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
                        'h2' => $this->reachedEndOfDefinitions = true,
                        'h3' => $this->initializeType($node, $fileName),
                        'h4' => $this->initializeSubtype($node, $fileName),
                        'table' => $this->extractProperties($node, $this->getTableSeverity($node), $fileName),
                        default => null,
                    };
                });

            $this->pushCurrentType();
            $this->currentType = null;
            $this->reachedEndOfDefinitions = false;
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
            $this->extractedTypes[$this->currentType->name] = $this->currentType;
        }

        if ($this->currentType?->isASubtype) {
            $this->extractedTypes[$this->currentType->parentType->name] = $this->currentType->parentType;
        }
    }

    private function initializeType(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefinitions) {
            return;
        }

        $this->propertyToUpdate = null;
        $name = $node->text();

        if ('Restaurant carousel (limited access)' === $name || str_contains($name, 'ItemList')) {
            $this->initializeCarousel($name, true);

            return;
        }

        if (str_contains($name, 'ListItem')) {
            $this->definePropertyToUpdate($name, 'itemListElement');

            return;
        }

        // Regular pages use some `.` to mark the nested properties expected values.
        // But the book page also uses new tables with `()` in the title to indicate the property.
        // And it still uses some `.` as well.
        // This causes quite a lot of issues and chaos...
        if (preg_match('/\((.+)\)/', $name, $matches)) {
            if (!str_contains(strtolower($name), 'beta')) {
                $this->definePropertyToUpdate($name, $matches[1]);

                return;
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
            $typeName = explode(' ', $name);

            $this->currentType = new Type();
            $this->currentType->name = $typeName[0];
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

            if ('Movie' === $name) {
                $this->initializeCarousel($name);

                return;
            }
        }
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

    private function initializeSubtype(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefinitions) {
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

    private function initializeCarousel(bool $replaceCurrentType = false): void
    {
        // TODO : should be HowToTip... The `and` is not handled in the titles
        if ('HowToDirection' === $this->currentType->name) {
            $this->pushCurrentType();
            $this->currentType = $this->extractedTypes['Recipe'];
        }

        $this->currentType->isCarouselEligible = true;

        $carousel = new Type();
        $carousel->parentType = $this->currentType;
        $carousel->isASubtype = true;
        $carousel->initProperty('itemListElement', self::SEVERITY_REQUIRED);
        $carousel->pushProperty('ListItem');
        $carousel->addPropertyProperty('position', ['itemListElement', ['ListItem']], self::SEVERITY_REQUIRED);
        $carousel->pushProperty('Integer');
        $carousel->addPropertyProperty('url', ['itemListElement', ['ListItem']], self::SEVERITY_REQUIRED);
        $carousel->pushProperty('URL');
        $carousel->cleanUpProperties(self::SEVERITY_REQUIRED);

        $this->currentType->carousel = $carousel;

        if ($replaceCurrentType) {
            $this->currentType = $this->currentType->carousel;
        }
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
        if ($this->reachedEndOfDefinitions) {
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
            fn (\DOMNode $node) => $this->extractKeyCellCodeEntries($node),
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

        /**
         * @var array<\DOMNode> $codeEntries
         */
        foreach (array_filter($codeEntries) as $codeTag) {
            foreach (iterator_to_array($codeTag->childNodes) as $nodeEntry) {
                if ('a' === $nodeEntry->nodeName) {
                    $this->handleValue($nodeEntry, $nodeEntry->attributes, $isABetaTable);

                    continue;
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

    private function extractKeyCellCodeEntries(\DOMNode $node): ?\DOMNode
    {
        if ('code' === $node->nodeName) {
            return $node;
        }

        if ('h3' === $node->nodeName) {
            foreach (iterator_to_array($node->childNodes) as $child) {
                if ('code' === $child->nodeName) {
                    return $child;
                }
            }
        }

        return null;
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
                dump($name, $this->propertyToUpdate);
                $this->currentType->addPropertyProperty($name, $this->propertyToUpdate, $severity, $isABetaTable);
                dump($this->currentType);
            }
        } else {
            // Sometimes the property name is inside a `h3` tag and has a lot of whitespace and carriage returns.
            $cleanedPropertyName = preg_replace('/[^a-zA-Z\d.]/', '', $name);

            $this->currentType->initProperty($cleanedPropertyName, $severity, $isABetaTable, $atLeastOneOf);
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
