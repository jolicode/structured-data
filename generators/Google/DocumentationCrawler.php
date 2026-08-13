<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators\Google;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Crawls the Google structured data gallery and downloads the documentation
 * pages the validation classes are generated from.
 */
readonly class DocumentationCrawler
{
    public const TYPES_SOURCE_URL = self::GOOGLE_DOMAIN . '/search/docs/appearance/structured-data';

    private const GOOGLE_DOMAIN = 'https://developers.google.com';
    private const DOWNLOAD_DIRECTORY = __DIR__ . '/../../resources/google/downloads';
    private const IGNORED_DOC_SLUGS = [
        'generate-structured-data-with-javascript',
        'intro-structured-data',
        'sd-policies',
        'search-gallery',
    ];
    private const URL_ALIASES = [
        'articl' => 'article',
    ];

    public function __construct(
        private SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
        private ManifestStore $manifestStore = new ManifestStore(),
    ) {
    }

    public function crawlGoogleDoc(): void
    {
        $client = HttpClient::create();
        $galleryUrls = $this->fetchGalleryUrls($client);

        if ([] === $galleryUrls) {
            throw new IOException('No links were found on the Google page. Maybe the page structure has changed?');
        }

        $manifest = $this->manifestStore->loadManifest();
        $manifestBySlug = $this->manifestStore->indexManifestEntriesBySlug($manifest);
        $manifestBySlug = $this->synchronizeManifestWithGallery($manifestBySlug, $galleryUrls);

        $this->warnAboutMissingActiveManifestEntries($manifestBySlug, $galleryUrls);

        ksort($manifestBySlug);
        $this->manifestStore->saveManifest(array_values($manifestBySlug));

        foreach ($manifestBySlug as $entry) {
            if (!$this->manifestStore->shouldDownloadManifestEntry($entry)) {
                continue;
            }

            $filteredContent = $this->downloadStructuredDataTables($client, $entry['url']);

            if ([] === $filteredContent) {
                continue;
            }

            $fileName = \sprintf('%s/%s.html', self::DOWNLOAD_DIRECTORY, $entry['slug']);
            $this->filesystem->dumpFile($fileName, implode("\n", $filteredContent));
        }
    }

    public function normalizeStructuredDataUrl(string $link): ?string
    {
        if (false === filter_var($link, \FILTER_VALIDATE_URL)) {
            if (!str_starts_with($link, '/')) {
                return null;
            }

            $link = self::GOOGLE_DOMAIN . $link;
        }

        $link = strtok($link, '#') ?: $link;
        $link = strtok($link, '?') ?: $link;

        if (!str_starts_with($link, self::TYPES_SOURCE_URL)) {
            return null;
        }

        $slug = basename($link);
        $slug = self::URL_ALIASES[$slug] ?? $slug;

        if (\in_array($slug, self::IGNORED_DOC_SLUGS, true)) {
            return null;
        }

        return preg_replace('#/[^/]+$#', '/' . $slug, $link) ?: null;
    }

    /**
     * @param array<int, string> $seedUrls
     *
     * @return array{0: array<string, array{classification: string, title: string}>, 1: array<string, string>}
     */
    public function discoverStructuredDataDocs(HttpClientInterface $client, array $seedUrls): array
    {
        $queue = [];
        $visited = [];
        $discovered = [];
        $failures = [];

        foreach ($seedUrls as $seedUrl) {
            $queue[] = $seedUrl;
        }

        while ([] !== $queue) {
            $currentUrl = array_shift($queue);

            if (isset($visited[$currentUrl])) {
                continue;
            }

            $visited[$currentUrl] = true;

            try {
                $content = $client->request('GET', $currentUrl)->getContent();
            } catch (\Throwable $exception) {
                $failures[$currentUrl] = $exception->getMessage();

                continue;
            }

            $crawler = new Crawler($content);
            $title = trim((string) $crawler->filter('title')->first()->text('', true));

            if (self::TYPES_SOURCE_URL . '/search-gallery' !== $currentUrl) {
                $discovered[$currentUrl] = [
                    'classification' => $this->classifyStructuredDataPage($content),
                    'title' => $title,
                ];
            }

            foreach ($this->extractStructuredDataLinks($crawler) as $url) {
                if (!isset($visited[$url])) {
                    $queue[] = $url;
                }
            }
        }

        return [$discovered, $failures];
    }

    /**
     * @return array<string, string>
     */
    private function fetchGalleryUrls(HttpClientInterface $client): array
    {
        $response = $client->request('GET', self::TYPES_SOURCE_URL . '/search-gallery');
        $crawler = new Crawler($response->getContent());

        return $this->extractStructuredDataLinks($crawler);
    }

    /**
     * @param array<string, array<string, mixed>> $manifestBySlug
     * @param array<string, string>               $galleryUrls
     *
     * @return array<string, array<string, mixed>>
     */
    private function synchronizeManifestWithGallery(array $manifestBySlug, array $galleryUrls): array
    {
        foreach ($galleryUrls as $slug => $url) {
            if (isset($manifestBySlug[$slug])) {
                continue;
            }

            $manifestBySlug[$slug] = ['slug' => $slug, 'url' => $url];
            echo \sprintf(
                '[WARNING] New type discovered in the gallery: "%s". Added to the manifest - review and annotate if needed.' . \PHP_EOL,
                $slug,
            );
        }

        return $manifestBySlug;
    }

    /**
     * @param array<string, array<string, mixed>> $manifestBySlug
     * @param array<string, string>               $galleryUrls
     */
    private function warnAboutMissingActiveManifestEntries(array $manifestBySlug, array $galleryUrls): void
    {
        foreach ($manifestBySlug as $slug => $entry) {
            $status = $entry['status'] ?? 'active';

            if (isset($galleryUrls[$slug])) {
                continue;
            }

            if (!\in_array($status, ['active'], true)) {
                continue;
            }

            echo \sprintf(
                '[WARNING] Type "%s" is in the manifest as "active" but is no longer listed in the gallery. Consider marking it as "retired" or "extra".' . \PHP_EOL,
                $slug,
            );
        }
    }

    /**
     * @return array<int, string>
     */
    private function downloadStructuredDataTables(HttpClientInterface $client, string $url): array
    {
        $content = new Crawler($client->request('GET', $url)->getContent());
        $definitions = $content->filter('[data-text*="Structured data type definitions"]');

        if (0 === $definitions->count()) {
            return [];
        }

        return $definitions->nextAll()
            ->filter('table')
            ->each(static fn (Crawler $node) => $node->outerHtml());
    }

    /**
     * @return array<string, string>
     */
    private function extractStructuredDataLinks(Crawler $crawler): array
    {
        $urls = [];

        foreach ($crawler->filter('a[href]')->extract(['href']) as $link) {
            $normalizedUrl = $this->normalizeStructuredDataUrl($link);

            if (null === $normalizedUrl) {
                continue;
            }

            $slug = basename($normalizedUrl);
            $urls[$slug] = $normalizedUrl;
        }

        return $urls;
    }

    private function classifyStructuredDataPage(string $content): string
    {
        if (str_contains($content, 'Structured data type definitions')) {
            return 'concrete';
        }

        if (str_contains($content, 'Deciding which markup to use')) {
            return 'hub';
        }

        if (str_contains($content, 'Supported types') && str_contains($content, 'WebPageElement')) {
            return 'pattern';
        }

        return 'unknown';
    }
}
