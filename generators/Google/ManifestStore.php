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

use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

/**
 * Reads and writes the curated Google documentation manifest.
 *
 * @phpstan-type ManifestEntry array{slug: string, url: string, status?: 'extra'|'retired'|'skip', note?: string}
 */
readonly class ManifestStore
{
    private const MANIFEST_DIRECTORY = __DIR__ . '/../../resources/google';
    private const MANIFEST_FILE = self::MANIFEST_DIRECTORY . '/google-types.json';

    public function __construct(
        private SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
    ) {
    }

    /**
     * @return list<ManifestEntry>
     */
    public function loadManifest(): array
    {
        if (!file_exists(self::MANIFEST_FILE)) {
            return [];
        }

        $manifest = json_decode((string) file_get_contents(self::MANIFEST_FILE), true);

        if (!\is_array($manifest)) {
            throw new \RuntimeException(\sprintf('The Google types manifest "%s" could not be decoded.', self::MANIFEST_FILE));
        }

        // The manifest is curated by hand and saved by saveManifest(): its entries
        // follow the ManifestEntry shape.
        /** @var list<ManifestEntry> $manifestEntries */
        $manifestEntries = $manifest;

        return $manifestEntries;
    }

    /**
     * @param list<ManifestEntry> $manifestEntries
     */
    public function saveManifest(array $manifestEntries): void
    {
        $this->filesystem->dumpFile(
            self::MANIFEST_FILE,
            json_encode($manifestEntries, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES) . "\n",
        );
    }

    /**
     * @param list<ManifestEntry> $manifest
     *
     * @return array<string, ManifestEntry>
     */
    public function indexManifestEntriesBySlug(array $manifest): array
    {
        $manifestBySlug = [];

        foreach ($manifest as $entry) {
            $manifestBySlug[$entry['slug']] = $entry;
        }

        return $manifestBySlug;
    }

    /**
     * @param ManifestEntry $entry
     */
    public function shouldDownloadManifestEntry(array $entry): bool
    {
        $status = $entry['status'] ?? 'active';

        return !\in_array($status, ['skip', 'retired'], true);
    }
}
