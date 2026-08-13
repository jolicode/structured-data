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
     * @return array<int, array<string, mixed>>
     */
    public function loadManifest(): array
    {
        if (!file_exists(self::MANIFEST_FILE)) {
            return [];
        }

        return json_decode((string) file_get_contents(self::MANIFEST_FILE), true) ?? [];
    }

    /**
     * @param array<int, array<string, mixed>> $manifestEntries
     */
    public function saveManifest(array $manifestEntries): void
    {
        $this->filesystem->dumpFile(
            self::MANIFEST_FILE,
            json_encode($manifestEntries, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES) . "\n",
        );
    }

    /**
     * @param array<int, array<string, mixed>> $manifest
     *
     * @return array<string, array<string, mixed>>
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
     * @param array<string, mixed> $entry
     */
    public function shouldDownloadManifestEntry(array $entry): bool
    {
        $status = $entry['status'] ?? 'active';

        return !\in_array($status, ['skip', 'retired'], true);
    }
}
