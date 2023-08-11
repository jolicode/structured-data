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
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Extractor
{
    private const LEVEL_RECOMMENDED = 'recommended';
    private const LEVEL_REQUIRED = 'required';

    private const GOOGLE_DOMAIN = 'https://developers.google.com';
    private const TYPES_SOURCE_URL = self::GOOGLE_DOMAIN . '/search/docs/appearance/structured-data';
    private const CACHE_DIRECTORY = __DIR__ . '/../../../var/cache/google/';

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
        $this->extractTypes('https://developers.google.com/search/docs/appearance/structured-data/book', $client);

        if ($refresh || !$this->filesystem->exists(self::CACHE_DIRECTORY)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::TYPES_SOURCE_URL . '/search-gallery');

            $crawler = new Crawler($response->getContent());

            foreach ($crawler->filter('article.devsite-article a.button-primary')->extract(['href']) as $typeLink) {
                if (false === filter_var($typeLink, \FILTER_VALIDATE_URL)) {
                    $typeLink = self::GOOGLE_DOMAIN . $typeLink;
                }

                if (str_starts_with($typeLink, self::TYPES_SOURCE_URL)) {
                    // dump($typeLink);
                    // $this->filesystem->dumpFile(self::CACHE_DIRECTORY, $this->extractTypes($typeLink, $client));
                    // $this->extractTypes($typeLink, $client);
                }
            }
        }

        // dump($this->extractedTypes);
        // dd($this->extractedTypes);
        exit;

        return $this->createContainer();
    }

    private function extractTypes(string $typeLink, HttpClientInterface $client): void
    {
        $response = $client->request('GET', $typeLink);
        $crawler = new Crawler($response->getContent());

        $definitions = $crawler->filter('[data-text*="Structured data type definitions"]');

        if ($definitions->count()) {
            $definitions
                ->nextAll()
                ->each(function (Crawler $node) use ($typeLink) {
                    match ($node->nodeName()) {
                        'h3' => $this->initializeType($node, $typeLink),
                        'h4' => $this->initializeSubtype($node, $typeLink),
                        'table' => $this->extractProperties($node),
                        default => null,
                    };
                });

            $this->pushCurrentType();
        }
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

    private function initializeType(Crawler $node, string $typeLink): void
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

            // Again the book page. Some examples are written inside h3 tags.
            if (\count($name) > 2) {
                return;
            }

            $this->pushCurrentType();

            $this->currentType = new Type();
            $this->currentType->name = $name[0];
            $this->currentType->documentationUrl = $typeLink . '#' . $node->attr('id');
        }
    }

    private function definePropertyToUpdate(string $fullTitle, string $targetProperty): void
    {
        $targetValues = preg_replace('/\s\((.+)\)/', '', $fullTitle);
        $targetValues = explode(' or ', $targetValues);

        $this->propertyToUpdate = ['property' => $targetProperty, 'values' => $targetValues];
    }

    private function initializeSubtype(Crawler $node, string $typeLink): void
    {
        $this->propertyToUpdate = null;
        $name = $node->text();
        preg_match('/\((.+)\)/', $name, $matches);

        if (!\array_key_exists(1, $matches)) {
            $this->initializeType($node, $typeLink);

            return;
        }

        $subType = $matches[1];

        $subType = new Type(
            name: $subType,
            isASubtype: true,
            parentType: $this->currentType->isASubtype ? $this->currentType->parentType : $this->currentType,
            documentationUrl: $typeLink . '#' . $node->attr('id'),
        );

        if ($this->currentType->isASubtype) {
            $this->currentType->parentType->subTypes[] = $subType;
        } else {
            $this->currentType->subTypes[] = $subType;
        }

        $this->currentType = $subType;
    }

    private function extractProperties(Crawler $table): void
    {
        match ($this->getTableSeverity($table)) {
            self::LEVEL_REQUIRED => $this->extractRequiredProperties($table),
            self::LEVEL_RECOMMENDED => $this->extractRecommendedProperties($table),
            default => null,
        };
    }

    private function getTableSeverity(Crawler $table): string
    {
        $severity = $table->filter('tr > th')->text();

        if (str_contains(strtolower($severity), 'required')) {
            return self::LEVEL_REQUIRED;
        }

        if (str_contains(strtolower($severity), 'recommended')) {
            return self::LEVEL_RECOMMENDED;
        }

        return '';
    }

    private function extractPropertiesForSeverity(Crawler $table, string $severity): void
    {
        $head = $table->filter('tr > th')->text();
        $isABetaTable = false;

        if (str_contains(strtolower($head), '(beta)')) {
            $isABetaTable = true;
        }

        $table
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) use ($isABetaTable) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if (
                            '#text' === $nodeEntry->nodeName
                            && ('td' === $codeTag->ancestors()->getNode(0)->nodeName || 'h3' === $codeTag->ancestors()->getNode(0)->nodeName)
                        ) {
                            if ($this->propertyToUpdate) {
                                if ($this->currentType->isASubtype) {
                                    foreach ($this->currentType->parentType->subTypes as $subType) {
                                        $subType->addPropertyRequiredProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                    }
                                } else {
                                    $this->currentType->addPropertyRequiredProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                }
                            } else {
                                $this->currentType->initRequiredProperty($nodeEntry->nodeValue, $isABetaTable);
                            }

                            continue;
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            foreach ($nodeEntry->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRequiredProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }

                        // Usually, the `a` tag is wrapped around the `code` tag. However, for the book page, it is the contrary... WEB SCRAPPING !
                        if (
                            '#text' === $nodeEntry->nodeName
                            && 'a' === $codeTag->ancestors()->getNode(0)->nodeName
                        ) {
                            foreach ($codeTag->ancestors()->getNode(0)->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRequiredProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpRequiredProperties();
    }

    private function extractRequiredProperties(Crawler $table): void
    {
        $head = $table->filter('tr > th')->text();
        $isABetaTable = false;

        if (str_contains(strtolower($head), '(beta)')) {
            $isABetaTable = true;
        }

        $table
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) use ($isABetaTable) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if (
                            '#text' === $nodeEntry->nodeName
                            && ('td' === $codeTag->ancestors()->getNode(0)->nodeName || 'h3' === $codeTag->ancestors()->getNode(0)->nodeName)
                        ) {
                            if ($this->propertyToUpdate) {
                                if ($this->currentType->isASubtype) {
                                    foreach ($this->currentType->parentType->subTypes as $subType) {
                                        $subType->addPropertyRequiredProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                    }
                                } else {
                                    $this->currentType->addPropertyRequiredProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                }
                            } else {
                                $this->currentType->initRequiredProperty($nodeEntry->nodeValue, $isABetaTable);
                            }

                            continue;
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            foreach ($nodeEntry->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRequiredProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }

                        // Usually, the `a` tag is wrapped around the `code` tag. However, for the book page, it is the contrary... WEB SCRAPPING !
                        if (
                            '#text' === $nodeEntry->nodeName
                            && 'a' === $codeTag->ancestors()->getNode(0)->nodeName
                        ) {
                            foreach ($codeTag->ancestors()->getNode(0)->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRequiredProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpRequiredProperties();
    }

    private function extractRecommendedProperties(Crawler $table): void
    {
        $head = $table->filter('tr > th')->text();
        $isABetaTable = false;

        if (str_contains(strtolower($head), '(beta)')) {
            $isABetaTable = true;
        }

        $table
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) use ($isABetaTable) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if (
                            '#text' === $nodeEntry->nodeName
                            && ('td' === $codeTag->ancestors()->getNode(0)->nodeName || 'h3' === $codeTag->ancestors()->getNode(0)->nodeName)
                        ) {
                            if ($this->propertyToUpdate) {
                                if ($this->currentType->isASubtype) {
                                    foreach ($this->currentType->parentType->subTypes as $subType) {
                                        $subType->addPropertyRecommendedProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                    }
                                } else {
                                    $this->currentType->addPropertyRecommendedProperty($nodeEntry->nodeValue, $this->propertyToUpdate, $isABetaTable);
                                }
                            } else {
                                $this->currentType->initRecommendedProperty($nodeEntry->nodeValue, $isABetaTable);
                            }

                            continue;
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            foreach ($nodeEntry->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRecommendedProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }

                        // Usually, the `a` tag is wrapped around the `code` tag. However, for the book page, it is the contrary... WEB SCRAPPING !
                        if (
                            '#text' === $nodeEntry->nodeName
                            && 'a' === $codeTag->ancestors()->getNode(0)->nodeName
                        ) {
                            foreach ($codeTag->ancestors()->getNode(0)->attributes as $attr) {
                                if ('class' === $attr->nodeName && 'external-link' === $attr->nodeValue) {
                                    $this->currentType->pushRecommendedProperty($nodeEntry->nodeValue, $isABetaTable);

                                    break;
                                }
                            }
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpRecommendedProperties();
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
