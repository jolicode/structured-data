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
        private bool $skipNextValueCell = false,

        /**
         * @var array<string, Type>
         */
        private array $extractedTypes = [],

        /**
         * @var array<string>
         */
        private array $typesWithSameProperties = [],
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

        foreach ($this->finder->files()->in(self::CACHE_DIRECTORY) as $file) {
            $this->extractTypes($file->getFilename(), file_get_contents($file->getRealPath()));
        }

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

        if (\count($this->typesWithSameProperties)) {
            foreach ($this->typesWithSameProperties as $type) {
                $clone = clone $this->currentType;
                $clone->name = $type;
                $clone->types = $type;
                $this->extractedTypes[$clone->name] = $clone;
            }

            $this->typesWithSameProperties = [];
        }
    }

    private function initializeType(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefinitions) {
            return;
        }

        $this->propertyToUpdate = null;
        $name = $node->text();

        if (\array_key_exists($name, $this->extractedTypes)) {
            $this->currentType = $this->extractedTypes[$name];

            return;
        }

        if ($this->initializeSpecialCaseType($name, $fileName, $node)) {
            return;
        }

        if ($this->shouldSkipTitle($name)) {
            return;
        }

        $this->pushCurrentType();

        $this->currentType = new Type();
        $this->currentType->name = $name = $this->extractRealTypeName($node);
        $this->currentType->types = $name;
        $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

        if ('Movie' === $name) {
            $this->initializeCarousel($fileName);

            return;
        }
    }

    /**
     * The Google documentation is not really consistent and it may do the same things in different ways.
     * We unfortunately need to handle these special cases ourselves.
     */
    private function initializeSpecialCaseType(string $name, string $fileName, Crawler $node): bool
    {
        if ('employer-rating.html' === $fileName) {
            $this->currentType = $this->extractedTypes['EmployerAggregateRating'];

            $this->currentType = new Type();
            $this->currentType->name = 'EmployerAggregateRating';
            $this->currentType->types = 'EmployerAggregateRating';
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

            return true;
        }

        if (str_contains(strtolower($name), 'beta')) {
            // Beta properties should be added directly on the current type so we skip initializing a new type.
            return true;
        }

        if ('Restaurant carousel (limited access)' === $name || str_contains($name, 'ItemList')) {
            $this->currentType = $this->extractedTypes[array_key_last($this->extractedTypes)];
            $this->initializeCarousel($fileName, true);

            return true;
        }

        if (str_contains($name, 'ListItem')) {
            $this->definePropertyToUpdate($name, 'itemListElement');

            return true;
        }

        if (str_contains($name, ' and ')) {
            $this->pushCurrentType();

            $types = explode(' and ', $name);
            $this->typesWithSameProperties = \array_slice($types, 1);

            $this->currentType = new Type();
            $this->currentType->name = $types[0];
            $this->currentType->types = $types[0];
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

            return true;
        }

        // The Learning Video type is actually a combination of 2 types. It is the only one for now but Google could add more in the future.
        if (($openingBracket = strpos($name, '[')) && str_contains($name, ']')) {
            $this->pushCurrentType();

            $types = substr($name, $openingBracket + 1, -1);
            $types = explode(', ', $types);
            $name = substr($name, 0, $openingBracket - 1);

            $dependsOn = $node
                ->nextAll()
                ->filter('p b a')
                ->getNode(0)
                ->nodeValue
            ;

            $this->currentType = new Type();
            $this->currentType->name = $name;
            $this->currentType->types = $types;
            $this->currentType->dependsOn = $dependsOn;
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

            return true;
        }

        // Regular pages use some `.` to mark the nested properties expected values.
        // But the book page also uses new tables with `()` in the title to indicate the property.
        // And it still uses some `.` as well.
        // This causes quite a lot of issues and chaos...
        if (preg_match('/\((.+)\)/', $name, $matches)) {
            $this->definePropertyToUpdate($name, $matches[1]);

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

    private function extractRealTypeName(Crawler $node): string
    {
        $codeTags = $node->filter('code');

        // Most of the time, the type name is inside a `code` tag, so we just need to get its value
        if (1 === $codeTags->count()) {
            $name = $codeTags->getNode(0)->nodeValue;
        }

        // But sometimes, there are none...
        if (0 === $codeTags->count()) {
            $name = $node->text();
        }

        // We don't need to check if there are more than 1 code tag because these are special cases handled by `initializeSpecialCaseType`

        // The book page adds a useless `entity` keyword. Other types are written in PascalCase so its fine.
        if (str_contains($name, 'entity')) {
            $name = str_replace(' entity', '', $name);
        }

        return $name;
    }

    /**
     * This method is used to indicate that instead of initializing a new property on the current type,
     * we should add the next property to an already existing property of the current type.
     */
    private function definePropertyToUpdate(string $fullTitle, string $targetProperty): void
    {
        $targetValues = preg_replace('/\s\((.+)\)/', '', $fullTitle);
        $targetValues = explode(' or ', $targetValues);

        $this->propertyToUpdate = [$targetProperty, $targetValues];
    }

    /**
     * Yes, Google forgot the title for some of its types.
     */
    private function initializeTypeWithNoTitle(string $fileName): bool
    {
        $typesWithMissingTitle = [
            'image-license-metadata.html' => 'ImageObject',
            'employer-rating.html' => 'EmployerAggregateRating',
        ];

        if (\array_key_exists($fileName, $typesWithMissingTitle)) {
            if (!\array_key_exists($typesWithMissingTitle[$fileName], $this->extractedTypes)) {
                $this->pushCurrentType();

                $this->currentType = new Type();
                $this->currentType->name = $typesWithMissingTitle[$fileName];
                $this->currentType->types = $typesWithMissingTitle[$fileName];
                $this->currentType->documentationUrl = $this->generateGoogleLink($fileName) . '#structured-data-type-definitions';

                return true;
            }

            $this->currentType = $this->extractedTypes[$typesWithMissingTitle[$fileName]];

            return true;
        }

        return false;
    }

    private function initializeSubtype(Crawler $node, string $fileName): void
    {
        if ($this->reachedEndOfDefinitions) {
            return;
        }

        $this->propertyToUpdate = null;
        $name = $node->text();
        preg_match('/\((.+)\)/', $name, $matches);

        if (!\array_key_exists(1, $matches)) {
            $this->initializeType($node, $fileName);

            return;
        }

        $this->currentType = $this->extractedTypes[array_key_last($this->extractedTypes)];

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

    /**
     * A type may be eligible for a carousel. Unfortunately, the documentation is not consistent at all for carousels.
     * This method defines the base properties that must be present for a type to be eligible for a carousel.
     */
    private function initializeCarousel(string $fileName, bool $replaceCurrentType = false): void
    {
        // The carousel table for the recipe type is at the bottom of document, so we need to retrieve the recipe type ourselves.
        if ('recipe.html' === $fileName) {
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
            ->filter('tbody:not(.list) > tr')
            ->each(function (Crawler $row) use ($isABetaTable, $severity) {
                $keyNode = $row->filter('td')->getNode(0);
                $valueNode = $row->filter('td')->getNode(1);

                if (null === $keyNode || null === $valueNode) {
                    return;
                }

                $this->extractKeyCell($keyNode, $isABetaTable, $severity);

                if ($this->skipNextValueCell) {
                    $this->skipNextValueCell = false;

                    return;
                }

                $this->extractValueCell($valueNode, $isABetaTable);
            });

        // Unfortunately, some types need some fixing after having being crawled.
        BrokenTypeFixer::fixType($this->currentType);

        $this->currentType->cleanUpProperties($severity);
        $this->pushCurrentType();
        $this->currentType = null;
    }

    private function extractKeyCell(\DOMNode $keyNode, bool $isABetaTable, string $severity): void
    {
        $crawler = new Crawler($keyNode);
        $codeTags = $crawler->filter('code');

        if (1 === \count($codeTags)) {
            $this->handleNewProperty($codeTags->getNode(0)->nodeValue, $severity, $isABetaTable);

            return;
        }

        if (1 < \count($codeTags)) {
            $atLeastOneOf = array_map(
                fn (\DOMNode $node) => new Property($node->nodeValue),
                iterator_to_array($codeTags),
            );

            $this->handleNewProperty('atLeastOneOf', $severity, $isABetaTable, $atLeastOneOf);
            $this->currentType->cleanUpProperties($severity);

            return;
        }

        // Sometimes, a key cell is just broken and should be skipped. This is why we have a BrokenTypeFixer.
        // When this is the case, we just want to skip the next value cell, as it would otherwise just break things.
        $this->skipNextValueCell = true;
    }

    private function extractValueCell(\DOMNode $valueNode, bool $isABetaTable): void
    {
        $crawler = new Crawler($valueNode);
        $codeTags = $crawler->filter('p:first-child code');
        $linkTags = $crawler->filter('p:first-child a.external-link');

        if (!$linkTags->count()) {
            return;
        }

        $codeTags->each(fn (Crawler $node) => $this->handleValue($node->getNode(0), $isABetaTable));
    }

    /**
     * When we encounter a property, most of the time we just need to initialize it on the current type.
     * However, sometimes, this property is a subproperty of another property.
     * And sometimes, this subproperty belongs to a subtype.
     *
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
            // Sometimes the property name is inside a `h3` tag and has a lot of whitespace and carriage returns.
            $cleanedPropertyName = preg_replace('/[^a-zA-Z\d.-@]/', '', $name);

            $this->currentType->initProperty($cleanedPropertyName, $severity, $isABetaTable, $atLeastOneOf);
        }
    }

    /**
     * Extracts the value from the given node and pushes it to the current type.
     */
    private function handleValue(\DOMNode $nodeEntry, bool $isABetaTable): void
    {
        if (preg_match('/^\((.+)\)$/', $nodeEntry->nodeValue)) {
            $this->currentType->setCurrentValueSubtype($nodeEntry->nodeValue);

            return;
        }

        $this->currentType->pushProperty($nodeEntry->nodeValue, $isABetaTable);
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
