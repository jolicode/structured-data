<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators\Google;

use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class Filesystem
{
    public const GOOGLE_FIXTURES_DIR = __DIR__ . '/../../tests/Validation/fixtures/google';

    private const MANIFEST_DIRECTORY = __DIR__ . '/../../resources/google';
    private const DOWNLOAD_DIRECTORY = __DIR__ . '/../../resources/google/downloads';
    private const DATA_DIRECTORY = __DIR__ . '/../../resources/google/structured-data';
    private const GENERATED_CLASSES_DIR = __DIR__ . '/../../src/Vocabularies/Generated/Google';
    private const GOOGLE_DOMAIN = 'https://developers.google.com';
    private const TYPES_SOURCE_URL = self::GOOGLE_DOMAIN . '/search/docs/appearance/structured-data';
    private const MANIFEST_FILE = self::MANIFEST_DIRECTORY . '/google-types.json';
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
        private readonly SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
        private readonly Standard $prettyPrinter = new PrettyPrinter(),
    ) {
    }

    public function crawleGoogleDoc(): void
    {
        $client = HttpClient::create();
        $galleryUrls = $this->fetchGalleryUrls($client);

        if ([] === $galleryUrls) {
            throw new IOException('No links were found on the Google page. Maybe the page structure has changed?');
        }

        $manifest = $this->loadManifest();
        $manifestBySlug = $this->indexManifestEntriesBySlug($manifest);
        $manifestBySlug = $this->synchronizeManifestWithGallery($manifestBySlug, $galleryUrls);

        $this->warnAboutMissingActiveManifestEntries($manifestBySlug, $galleryUrls);

        ksort($manifestBySlug);
        $this->saveManifest(array_values($manifestBySlug));

        foreach ($manifestBySlug as $entry) {
            if (!$this->shouldDownloadManifestEntry($entry)) {
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

    /**
     * @return array{
     *     discovered: array<string, array{classification: string, title: string}>,
     *     manifest_urls: array<string, array<string, mixed>>,
     *     implemented_urls: array<string, array<string>>,
     *     missing_from_manifest: array<string, array{classification: string, title: string}>,
     *     missing_implementations: array<string, array{classification: string, title: string}>,
     *     stale_manifest_entries: array<string, array<string, mixed>>,
     *     fetch_failures: array<string, string>
     * }
     */
    public function verifyGoogleDocCoverage(): array
    {
        $client = HttpClient::create();
        $manifestEntries = $this->loadManifest();
        $manifestUrls = [];

        foreach ($manifestEntries as $entry) {
            $manifestUrls[$entry['url']] = $entry;
        }

        $seedUrls = [self::TYPES_SOURCE_URL . '/search-gallery'];

        foreach ($manifestEntries as $entry) {
            if ('retired' === ($entry['status'] ?? null)) {
                continue;
            }

            $seedUrls[] = $entry['url'];
        }

        [$discovered, $fetchFailures] = $this->discoverStructuredDataDocs($client, array_values(array_unique($seedUrls)));
        $implementedUrls = $this->getImplementedDocumentationUrls();

        $missingFromManifest = array_diff_key($discovered, $manifestUrls);
        $missingImplementations = [];

        foreach ($discovered as $url => $metadata) {
            if ('concrete' !== $metadata['classification']) {
                continue;
            }

            if (isset($implementedUrls[$url])) {
                continue;
            }

            $missingImplementations[$url] = $metadata;
        }

        $staleManifestEntries = [];

        foreach ($manifestUrls as $url => $entry) {
            $status = $entry['status'] ?? 'active';

            if (!\in_array($status, ['active', 'extra'], true)) {
                continue;
            }

            if (!isset($discovered[$url])) {
                $staleManifestEntries[$url] = $entry;
            }
        }

        ksort($discovered);
        ksort($missingFromManifest);
        ksort($missingImplementations);
        ksort($staleManifestEntries);
        ksort($fetchFailures);

        return [
            'discovered' => $discovered,
            'manifest_urls' => $manifestUrls,
            'implemented_urls' => $implementedUrls,
            'missing_from_manifest' => $missingFromManifest,
            'missing_implementations' => $missingImplementations,
            'stale_manifest_entries' => $staleManifestEntries,
            'fetch_failures' => $fetchFailures,
        ];
    }

    /**
     * @param \Generator<int, array{\PhpParser\Node\Stmt\Namespace_, string}> $types
     *
     * @return array<string>
     */
    public function writeClass(\Generator $types): array
    {
        $writtenClassNames = [];

        foreach ($types as [$type, $className]) {
            $this->filesystem->dumpFile(
                \sprintf('%s/%s.php', self::GENERATED_CLASSES_DIR, $className),
                $this->prettyPrinter->prettyPrintFile([$type]),
            );

            $writtenClassNames[] = $className;
        }

        return $writtenClassNames;
    }

    public function getJsonFiles(): Finder
    {
        return Finder::create()
            ->files()
            ->in(self::DATA_DIRECTORY)
            ->name('*.json')
            ->sortByName()
        ;
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
     * @param array<int, array<string, mixed>> $manifest
     *
     * @return array<string, array<string, mixed>>
     */
    private function indexManifestEntriesBySlug(array $manifest): array
    {
        $manifestBySlug = [];

        foreach ($manifest as $entry) {
            $manifestBySlug[$entry['slug']] = $entry;
        }

        return $manifestBySlug;
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
     * @param array<string, mixed> $entry
     */
    private function shouldDownloadManifestEntry(array $entry): bool
    {
        $status = $entry['status'] ?? 'active';

        return !\in_array($status, ['skip', 'retired'], true);
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
     * @return array<int, array<string, mixed>>
     */
    private function loadManifest(): array
    {
        if (!file_exists(self::MANIFEST_FILE)) {
            return [];
        }

        return json_decode((string) file_get_contents(self::MANIFEST_FILE), true) ?? [];
    }

    /**
     * @param array<int, array<string, mixed>> $manifestEntries
     */
    private function saveManifest(array $manifestEntries): void
    {
        $this->filesystem->dumpFile(
            self::MANIFEST_FILE,
            json_encode($manifestEntries, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES) . "\n",
        );
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

    private function normalizeStructuredDataUrl(string $link): ?string
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
    private function discoverStructuredDataDocs(HttpClientInterface $client, array $seedUrls): array
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

    /**
     * @return array<string, array<string>>
     */
    private function getImplementedDocumentationUrls(): array
    {
        $documentationUrls = [];

        foreach ($this->getJsonFiles() as $file) {
            $content = json_decode($file->getContents(), true);

            if (!\is_array($content)) {
                continue;
            }

            foreach ($this->extractDocumentationUrls($content) as $url) {
                $documentationUrls[$url][] = $file->getBasename('.json');
            }
        }

        ksort($documentationUrls);

        return $documentationUrls;
    }

    /**
     * @return array<int, string>
     */
    private function extractDocumentationUrls(array $content): array
    {
        $urls = [];
        /** @var array<mixed> $stack */
        $stack = [$content];

        while ([] !== $stack) {
            $current = array_pop($stack);

            if (!\is_array($current)) {
                continue;
            }

            foreach ($current as $key => $value) {
                if ('documentation' === $key && \is_string($value)) {
                    $normalizedUrl = $this->normalizeStructuredDataUrl($value);

                    if (null !== $normalizedUrl) {
                        $urls[] = $normalizedUrl;
                    }
                }

                if (\is_array($value)) {
                    $stack[] = $value;
                }
            }
        }

        return array_values(array_unique($urls));
    }
}
