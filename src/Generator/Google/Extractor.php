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

        $this->extractTypes('book.html', file_get_contents('/home/hedic/Dev/JoliCode/json-ld-projects/json-ld/var/cache/google/book.html'));
        // $this->extractTypes('https://developers.google.com/search/docs/appearance/structured-data/math-solvers', $client);

        foreach ($this->finder->files()->in(self::CACHE_DIRECTORY) as $file) {
            // $this->extractTypes($file->getFilename(), file_get_contents($file->getRealPath()));
        }

        dd($this->extractedTypes);
        exit;

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
                        'h3' => $this->initializeType($node, $fileName),
                        'h4' => $this->initializeSubtype($node, $fileName),
                        'table' => $this->extractProperties($node, $this->getTableSeverity($node)),
                        default => null,
                    };
                });

            $this->pushCurrentType();
        }
    }

    private function generateGoogleLink(string $fileName, string $anchor): string
    {
        $typeLink = str_replace('.html', '', $fileName);
        $typeLink = sprintf('%s/%s', self::TYPES_SOURCE_URL, $typeLink);

        return sprintf('%s#%s', $typeLink, $anchor);
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

    private function initializeType(Crawler $node, string $fileName): void
    {
        $this->propertyToUpdate = null;
        $name = $node->text();

        // Regular pages use some `.` to mark the nested properties expected values.
        // But the book page also uses new tables with `()` in the title to indicate the property.
        // And it still uses some `.` as well.
        // This causes quite a lot of issues and chaos...
        if (preg_match('/\((.+)\)/', $name, $matches)) {
            $this->definePropertyToUpdate($name, $matches[1]);
        } else {
            // The book page adds a useless `entity` keyword. Other types are written in PascalCase so its fine.
            $name = explode(' ', $name);

            $this->pushCurrentType();

            // Again the book page. Some examples are written inside h3 tags.
            if (\count($name) > 2) {
                $this->currentType = null;

                return;
            }

            $this->currentType = new Type();
            $this->currentType->name = $name[0];
            $this->currentType->documentationUrl = $this->generateGoogleLink($fileName, $node->attr('id'));
        }
    }

    private function definePropertyToUpdate(string $fullTitle, string $targetProperty): void
    {
        $targetValues = preg_replace('/\s\((.+)\)/', '', $fullTitle);
        $targetValues = explode(' or ', $targetValues);

        $this->propertyToUpdate = ['property' => $targetProperty, 'values' => $targetValues];
    }

    private function initializeSubtype(Crawler $node, string $fileName): void
    {
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

    private function extractProperties(Crawler $table, string $severity): void
    {
        if (!$this->currentType) {
            return;
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
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) use ($isABetaTable, $severity) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if (
                            '#text' === $nodeEntry->nodeName
                            && ('td' === $codeTag->ancestors()->getNode(0)->nodeName || 'h3' === $codeTag->ancestors()->getNode(0)->nodeName)
                        ) {
                            $this->handleNewProperty($nodeEntry, $severity, $isABetaTable);
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            $this->handleValue($nodeEntry, $nodeEntry->attributes, $isABetaTable);
                        }

                        // Usually, the `a` tag is wrapped around the `code` tag. However, for the book page, it is the contrary... WEB SCRAPPING !
                        if (
                            '#text' === $nodeEntry->nodeName
                            && 'a' === $codeTag->ancestors()->getNode(0)->nodeName
                        ) {
                            $this->handleValue($nodeEntry, $codeTag->ancestors()->getNode(0)->attributes, $isABetaTable);
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpProperties($severity);
    }

    private function handleNewProperty(\DOMNode $nodeEntry, string $severity, bool $isABetaTable): void
    {
        // if ($this->propertyToUpdate) {
        //     if ($this->currentType->isASubtype) {
        //         foreach ($this->currentType->parentType->subTypes as $subType) {
        //             $subType->addPropertyProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $severity, $isABetaTable);
        //         }
        //     } else {
        //         $this->currentType->addPropertyProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $severity, $isABetaTable);
        //     }
        // } else {
        // $this->currentType->initProperty($nodeEntry->nodeValue, $severity, $isABetaTable);
        // }

        dump($nodeEntry->nodeValue, $this->propertyToUpdate);

        $this->currentType->initProperty($nodeEntry->nodeValue, $severity, $isABetaTable);
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
