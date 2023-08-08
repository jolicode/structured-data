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

        /**
         * @var array<string, Type>
         */
        private array $extractedTypes = [],
    ) {
    }

    public function extractClasses(bool $refresh): ClassesContainer
    {
        $client = HttpClient::create();

        $this->extractTypes('https://developers.google.com/search/docs/appearance/structured-data/course', $client);

        if ($refresh || !$this->filesystem->exists(self::CACHE_DIRECTORY)) {
            $client = HttpClient::create();
            $response = $client->request('GET', self::TYPES_SOURCE_URL . '/search-gallery');

            $crawler = new Crawler($response->getContent());

            foreach ($crawler->filter('article.devsite-article a.button-primary')->extract(['href']) as $typeLink) {
                if (false === filter_var($typeLink, \FILTER_VALIDATE_URL)) {
                    $typeLink = self::GOOGLE_DOMAIN . $typeLink;
                }

                if (str_starts_with($typeLink, self::TYPES_SOURCE_URL)) {
                    dump($typeLink);
                    // $this->filesystem->dumpFile(self::CACHE_DIRECTORY, $this->extractTypes($typeLink, $client));
                    $this->extractTypes($typeLink, $client);
                }
            }
        }

        return $this->createContainer();
    }

    private function extractTypes(string $typeLink, HttpClientInterface $client): void
    {
        $response = $client->request('GET', $typeLink);
        $crawler = new Crawler($response->getContent());

        $crawler
            ->filter('[data-text*="Structured data type definitions"]')
            ->nextAll()
            ->each(function (Crawler $node) use ($typeLink) {
                match ($node->nodeName()) {
                    'h3' => $this->initializeType($node, $typeLink),
                    'table' => $this->extractProperties($node),
                    default => null,
                };
            });

        $this->pushCurrentType();
        dd($this->extractedTypes);
    }

    private function pushCurrentType(): void
    {
        if ($this->currentType && !$this->currentType->isEmpty()) {
            $this->extractedTypes[] = $this->currentType;
        }
    }

    private function initializeType(Crawler $node, string $typeLink): void
    {
        $this->pushCurrentType();

        $this->currentType = new Type();
        $this->currentType->name = $node->text();
        $this->currentType->documentationUrl = $typeLink . '#' . $node->attr('id');
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
        $severity = $table->filter('thead > tr > th')->text();

        if (str_contains(strtolower($severity), 'required')) {
            return self::LEVEL_REQUIRED;
        }

        if (str_contains(strtolower($severity), 'recommended')) {
            return self::LEVEL_RECOMMENDED;
        }

        return '';
    }

    private function extractRequiredProperties(Crawler $table): void
    {
        $table
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if ('#text' === $nodeEntry->nodeName) {
                            $this->currentType->initRequiredProperty($nodeEntry->nodeValue);

                            continue;
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            $this->currentType->pushRequiredProperty($nodeEntry->nodeValue);

                            continue;
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpRequiredProperties();
    }

    private function extractRecommendedProperties(Crawler $table): void
    {
        $table
            ->filter('tbody > tr td code')
            ->each(function (Crawler $codeTag) {
                foreach ($codeTag as $childNode) {
                    foreach ($childNode->childNodes as $nodeEntry) {
                        if ('#text' === $nodeEntry->nodeName && 'td' === $codeTag->ancestors()->getNode(0)->nodeName) {
                            $this->currentType->initRecommendedProperty($nodeEntry->nodeValue);
                        }

                        if ('a' === $nodeEntry->nodeName) {
                            $this->currentType->pushRecommendedProperty($nodeEntry->nodeValue);
                        }
                    }
                }
            })
        ;

        $this->currentType->cleanUpRecommendedProperties();
    }

    private function createContainer(): ClassesContainer
    {
        dd($this->extractedTypes);

        $container = new ClassesContainer();

        // foreach ($this->finder->files()->in(self::CACHE_DIRECTORY) as $googleType) {
        //     dd($googleType);
        // }

        return $container;
    }
}
