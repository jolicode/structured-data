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

use Jolicode\JsonLd\Generator\Google\Objects\MainType;
use Jolicode\JsonLd\Generator\Google\Objects\Property;
use Jolicode\JsonLd\Generator\Google\Objects\PropertyType;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpClient\HttpClient;

class Extractor
{
    public const SEVERITY_RECOMMENDED = 'recommended';
    public const SEVERITY_REQUIRED = 'required';

    public const GENERATED_DIR = __DIR__ . '/../../../generated/Google';

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
        private readonly Finder $finder = new Finder(),

        private ?MainType $currentType = null,
        private ?array $propertyToUpdate = null,
        private bool $reachedEndOfDefinitions = false,
        private bool $skipNextValueCell = false,

        /**
         * @var array<string, MainType>
         */
        private array $currentPageTypes = [],

        /**
         * @var array<string, MainType>
         */
        private array $extractedTypes = [],

        /**
         * @var array<string>
         */
        private array $typesWithSameProperties = [],
    ) {
    }

    /**
     * @return array<string, MainType>
     */
    public function extractClasses(bool $refresh): array
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
            // The product page is completely different and needs to be crawled separately. Unsupported for now.
            if ('product.html' === $file->getFilename()) {
                continue;
            }

            $this->extractTypes($file->getFilename(), file_get_contents($file->getRealPath()));
        }

        foreach ($this->extractedTypes as $type) {
            BrokenTypeFixer::fixType($type);
            $type->cleanUpProperties();
        }

        return $this->extractedTypes;
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
            $this->flushCurrentPageTypes();
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

    private function flushCurrentPageTypes(): void
    {
        foreach ($this->currentPageTypes as $type) {
            $this->extractedTypes[$type->name] = $type;
        }

        $this->currentPageTypes = [];
    }

    private function pushCurrentType(): void
    {
        if (
            $this->currentType
            && !\array_key_exists($this->currentType->name, $this->currentPageTypes)
            && !$this->currentType->isASubtype
        ) {
            $this->currentPageTypes[$this->currentType->name] = $this->currentType;
        }

        if ($this->currentType?->isASubtype) {
            $this->currentPageTypes[$this->currentType->parentType->name] = $this->currentType->parentType;
        }

        if (\count($this->typesWithSameProperties)) {
            foreach ($this->typesWithSameProperties as $type) {
                $clone = clone $this->currentType;
                $clone->name = $type;
                $this->currentPageTypes[$clone->name] = $clone;
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
            $this->initializeSubtypeWithParent($name, $fileName, $node);

            return;
        }

        if ($this->initializeSpecialCaseType($name, $fileName, $node)) {
            return;
        }

        if ($this->shouldSkipTitle($name)) {
            return;
        }

        $this->pushCurrentType();

        $this->currentType = new MainType();
        $this->currentType->name = $name = $this->extractRealTypeName($node);
        $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

        // The ItemList is not specified on the movie page, so we have to add it ourselves.
        if ('Movie' === $name) {
            $this->initializeCarousel('Movie');
        }
    }

    /**
     * The Google documentation is not really consistent and it may do the same things in different ways.
     * We unfortunately need to handle these special cases ourselves.
     */
    private function initializeSpecialCaseType(string $name, string $fileName, Crawler $node): bool
    {
        if ('employer-rating.html' === $fileName) {
            $this->currentType = new MainType();
            $this->currentType->name = 'EmployerAggregateRating';
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));

            return true;
        }

        if (str_contains(strtolower($name), 'beta')) {
            // Beta properties should be added directly on the current type so we skip initializing a new type.
            return true;
        }

        if ('Restaurant carousel (limited access)' === $name || str_contains(strtolower($name), 'itemlist')) {
            $typeName = match ($fileName) {
                'recipe.html' => 'Recipe',
                'course.html' => 'Course',
                'local-business.html' => 'LocalBusiness',
                'video.html' => 'VideoObject',
                default => throw new \RuntimeException(sprintf('A carousel was detected on the "%s" page, but it is not handled yet.', $fileName))
            };

            $this->initializeCarousel($typeName);

            return true;
        }

        if (str_contains(strtolower($name), 'listitem')) {
            $this->definePropertyToUpdate($name, 'itemListElement');

            return true;
        }

        if (str_contains($name, ' and ')) {
            $this->pushCurrentType();

            $types = explode(' and ', $name);
            $this->typesWithSameProperties = \array_slice($types, 1);

            $this->currentType = new MainType();
            $this->currentType->name = $types[0];
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
                ->filter('p b code')
                ->getNode(0)
                ->nodeValue
            ;

            $this->currentType = new MainType();
            $this->currentType->name = $name;
            $this->currentType->multipleTypes = $types;
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

            // Since only the book page has these cases we can cheat a bit
            if (\array_key_exists('Book', $this->currentPageTypes) && \array_key_exists('Edition', $this->currentPageTypes['Book']->subTypes)) {
                $this->currentType = $this->currentPageTypes['Book']->subTypes['Edition'];
            } else {
                throw new \RuntimeException(sprintf('The "%s" page seems to have a special bahevior that is not yet handled.', $fileName));
            }

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
            'Tabular datasets',
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
        if (isset($name) && str_contains($name, 'entity')) {
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
    private function initializeTypeWithNoTitle(string $fileName): bool|MainType
    {
        $typesWithMissingTitle = [
            'image-license-metadata.html' => 'ImageObject',
            'employer-rating.html' => 'EmployerAggregateRating',
            'event.html' => 'Event',
        ];

        if (\array_key_exists($fileName, $typesWithMissingTitle)) {
            if (!\array_key_exists($typesWithMissingTitle[$fileName], $this->currentPageTypes)) {
                $this->pushCurrentType();

                $typeWithNoTitle = new MainType();
                $typeWithNoTitle->name = $typesWithMissingTitle[$fileName];
                $typeWithNoTitle->documentationUrl = $this->generateGoogleLink($fileName) . '#structured-data-type-definitions';

                return $typeWithNoTitle;
            }

            return $this->currentPageTypes[$typesWithMissingTitle[$fileName]];
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

        $this->pushCurrentType();

        $subType = $matches[1];
        $parentType = str_replace(sprintf(' (%s)', $subType), '', $name);
        $parentType = $this->currentPageTypes[$parentType] ?? $this->extractedTypes[$parentType];

        $subType = new MainType(
            name: $subType,
            documentationUrl: $this->generateGoogleLink($fileName, $node->attr('id')),
            isASubtype: true,
            parentType: $parentType,
        );

        $parentType->subTypes[$subType->name] = $subType;

        $this->currentType = $subType;
    }

    private function initializeSubtypeWithParent(string $name, string $fileName, Crawler $node): void
    {
        $this->pushCurrentType();

        $previousType = $this->extractedTypes[$name];

        if (\count($previousType->subTypes) > 0) {
            $parent = $previousType;
        } else {
            $previousType->name = $previousTypeName = sprintf('%s%s', $this->getSubtypePrefix($previousType->documentationUrl), $name);
            $previousType->isASubtype = true;

            $parent = new MainType(
                name: $name,
                subTypes: [
                    $previousTypeName => $previousType,
                ],
            );

            $previousType->parentType = $parent;

            $this->extractedTypes[$name] = $parent;
        }

        $newType = new MainType(
            name: $newTypeName = sprintf('%s%s', $this->getSubtypePrefix($fileName), $name),
            documentationUrl: $this->generateGoogleLink($fileName, $node->attr('id')),
            isASubtype: true,
            parentType: $parent,
        );

        $parent->subTypes[$newTypeName] = $newType;

        $this->currentType = $newType;
    }

    private function initializeCarousel(string $typeName): void
    {
        $typeWithCarousel = $this->currentPageTypes[$typeName] ?? $this->currentType;
        $typeWithCarousel->isCarouselEligible = true;

        // The type requiring some special properties for its carousel is LocalBusiness.
        // Hence, we handle it that way since its quite annoying to handle it in a generic way.
        if ('LocalBusiness' === $typeName) {
            $image = new Property('image');
            $image->addType('URL');
            $image->addType('ImageObject');

            $name = new Property('name');
            $name->addType('Text');

            $address = new Property('address');
            $address->addType('PostalAddress');

            $servesCuisine = new Property('servesCuisine');
            $servesCuisine->addType('servesCuisine');

            $carousel = new PropertyType(
                name: 'Carousel',
                requiredProperties: ['image' => $image, 'name' => $name],
                recommendedProperties: ['address' => $address, 'servesCuisine' => $servesCuisine],
            );

            $typeWithCarousel->carousel = $carousel;
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
        if ($this->reachedEndOfDefinitions || !$severity) {
            return;
        }

        if (!$this->currentType) {
            if ($typeWithNoTitle = $this->initializeTypeWithNoTitle($fileName)) {
                $this->currentType = $typeWithNoTitle;
            } elseif (self::SEVERITY_RECOMMENDED === $severity) {
                $this->currentType = $this->currentPageTypes[array_key_last($this->currentPageTypes)];

                if ($this->currentType->isCarouselEligible) {
                    $this->currentType = null;

                    return;
                }

                if (\count($this->currentType->subTypes)) {
                    $this->currentType = $this->currentType->subTypes[array_key_last($this->currentType->subTypes)];
                }
            } else {
                return;
            }
        }

        $head = $table->filter('tr > th')->text();
        $isABetaTable = str_contains(strtolower($head), '(beta)');

        $table
            ->children()
            ->each(function (Crawler $node) use ($isABetaTable, $severity) {
                if ('tbody' === $node->nodeName()) {
                    $node->children()->each(function (Crawler $row) use ($isABetaTable, $severity) {
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

                        $this->extractValueCell($valueNode);
                    });
                }
            });

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
            $atLeastOneOf = [];

            foreach ($codeTags as $tag) {
                $atLeastOneOf[$tag->nodeValue] = new Property(
                    name: $tag->nodeValue,
                );
            }

            $this->handleNewProperty('atLeastOneOf', $severity, $isABetaTable, $atLeastOneOf);

            return;
        }

        // Sometimes, a key cell is just broken and should be skipped. This is why we have a BrokenTypeFixer.
        // When this is the case, we just want to skip the next value cell, as it would otherwise just break things.
        $this->skipNextValueCell = true;
    }

    private function extractValueCell(\DOMNode $valueNode): void
    {
        $crawler = new Crawler($valueNode);
        $firstChild = $crawler->children()->first();

        // Unfortunately, the value cells are quite inconsistent...
        // Most of the time, the values are located in the first paragraph
        // But sometimes, they are not, the `code` tags are direct children of the `td` tag
        // And sometimes, the `code` tag was forgotten
        $codeTags = match ($firstChild->nodeName()) {
            'p' => $firstChild->filter('a.external-link'),
            'code' => $firstChild->ancestors()->first()->children('code'),
            'a' => $firstChild->filter('a.external-link'),
            default => $crawler->filter('code'),
        };

        // There are special cases (which are not necessarily mistakes) handled by the BrokenTypeFixer
        if (!\count($codeTags)) {
            return;
        }

        $codeTags->each(fn (Crawler $node) => $this->handleValue($node->getNode(0)));
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
                    $subType->updateTypeWithProperty($name, $this->propertyToUpdate, $severity, $isABetaTable);
                }
            } else {
                $this->currentType->updateTypeWithProperty($name, $this->propertyToUpdate, $severity, $isABetaTable);
            }
        } else {
            // Sometimes the property name is inside a `h3` tag and has a lot of whitespace and carriage returns.
            $cleanedPropertyName = preg_replace('/[^a-zA-Z\d.@-]/', '', $name);

            $this->currentType->initProperty($cleanedPropertyName, $severity, $isABetaTable, $atLeastOneOf);
        }
    }

    /**
     * Extracts the value from the given node and pushes it to the current type.
     */
    private function handleValue(\DOMNode $nodeEntry): void
    {
        if (preg_match('/^\((.+)\)$/', $nodeEntry->nodeValue)) {
            $this->currentType->setCurrentTypeSubtype($nodeEntry->nodeValue);

            return;
        }

        $this->currentType->pushProperty($nodeEntry->nodeValue);
    }

    private function getSubtypePrefix(string $urlOrFilename): string
    {
        return match (true) {
            str_contains($urlOrFilename, 'education-qa') => 'EducationQA',
            str_contains($urlOrFilename, 'qapage') => 'QA',
            str_contains($urlOrFilename, 'faqpage') => 'FAQ',
            str_contains($urlOrFilename, 'practice-problems') => 'PracticeProblem',
            default => throw new \RuntimeException(sprintf('Trying to get a subtype prefix for the "%s" URL, which is not supported', $urlOrFilename))
        };
    }
}
