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

use Symfony\Component\HttpClient\HttpClient;

/**
 * Compares the live Google structured data documentation against the curated
 * manifest and the validation classes currently implemented.
 */
readonly class DocumentationCoverageAuditor
{
    public function __construct(
        private Filesystem $filesystem = new Filesystem(),
        private ManifestStore $manifestStore = new ManifestStore(),
        private DocumentationCrawler $crawler = new DocumentationCrawler(),
    ) {
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
        $manifestEntries = $this->manifestStore->loadManifest();
        $manifestUrls = [];

        foreach ($manifestEntries as $entry) {
            $manifestUrls[$entry['url']] = $entry;
        }

        $seedUrls = [DocumentationCrawler::TYPES_SOURCE_URL . '/search-gallery'];

        foreach ($manifestEntries as $entry) {
            if ('retired' === ($entry['status'] ?? null)) {
                continue;
            }

            $seedUrls[] = $entry['url'];
        }

        [$discovered, $fetchFailures] = $this->crawler->discoverStructuredDataDocs($client, array_values(array_unique($seedUrls)));
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
     * @return array<string, array<string>>
     */
    private function getImplementedDocumentationUrls(): array
    {
        $documentationUrls = [];

        foreach ($this->filesystem->getJsonFiles() as $file) {
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
                    $normalizedUrl = $this->crawler->normalizeStructuredDataUrl($value);

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
