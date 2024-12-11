<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator;

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Generator\SchemaOrg\Extractor;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;

readonly class Filesystem
{
    private const GENERATED_DIR = __DIR__ . '/../../../src/SchemaOrg/Generated';
    private const RESOURCES = __DIR__ . '/../../../resources';
    private const CACHE_DIR = __DIR__ . '/../../../var/cache';
    private const CACHE_DIR_SCHEMA_ORG = self::CACHE_DIR . '/schema-org';
    private const CACHE_DIR_W3C_TEST_SUITE = self::CACHE_DIR . '/w3c-json-ld-api';

    public function __construct(
        private SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
    ) {
    }

    public function copyContextTestFixtures(): void
    {
        $this->filesystem->mirror(
            __DIR__ . '/../../../tests/Algorithms/fixtures/context',
            self::CACHE_DIR_W3C_TEST_SUITE . '/tests/context',
        );
    }

    public function hasSchemaOrgTypesDefinitionFile(): bool
    {
        return $this->filesystem->exists(
            $this->getSchemaOrgTypesDefinitionFilename(),
        );
    }

    public function hasW3CTestSuiteFiles(): bool
    {
        return $this->filesystem->exists(
            \sprintf('%s/tests/flatten/output', self::CACHE_DIR_W3C_TEST_SUITE),
        );
    }

    public function removeW3CTestSuite(): void
    {
        $this->filesystem->remove(self::CACHE_DIR_W3C_TEST_SUITE);
    }

    public function saveSchemaOrgClass(string $type, string $className, string $content): void
    {
        $this->filesystem->dumpFile(\sprintf(
            '%s/%s/%s.php',
            self::GENERATED_DIR,
            $type,
            $className,
        ), $content);
    }

    public function saveSchemaOrgExample(string $prefix, string $content): void
    {
        if (json_decode($content)) {
            $key = md5($content);
            $filename = \sprintf(
                '%s/schema.org/examples/%s-%s.json-ld',
                self::RESOURCES,
                $prefix,
                $key,
            );

            $this->filesystem->dumpFile($filename, $content);
        }
    }

    public function saveSchemaOrgTypesDefinitionFile(string $content): void
    {
        $this->filesystem->dumpFile($this->getSchemaOrgTypesDefinitionFilename(), $content);
    }

    public function saveW3CTestSuiteFile(string $content): void
    {
        $zipFileName = tempnam(sys_get_temp_dir(), 'w3c-json-ld-api');
        $this->filesystem->dumpFile($zipFileName, $content);

        $zip = new \ZipArchive();
        $zip->open($zipFileName);
        $zip->extractTo(self::CACHE_DIR_W3C_TEST_SUITE);
        $zip->close();

        foreach (Algorithms::algorithms() as $algorithm) {
            foreach (['-in.jsonld' => 'input', '-out.jsonld' => 'output'] as $suffix => $directory) {
                $targetDirectory = \sprintf('%s/tests/%s/%s', self::CACHE_DIR_W3C_TEST_SUITE, $algorithm->value, $directory);
                $this->filesystem->mkdir($targetDirectory);
                $files = (new Finder())
                    ->in(\sprintf('%s/json-ld-api-main/tests/%s', self::CACHE_DIR_W3C_TEST_SUITE, $algorithm->value))
                    ->files()
                    ->name('*' . $suffix)
                ;

                foreach ($files as $file) {
                    $this->filesystem->copy(
                        $file->getPathname(),
                        \sprintf('%s/%s', $targetDirectory, $file->getFilename()),
                        true,
                    );
                }
            }
        }

        // remove the zip archive and all the files
        $this->filesystem->remove($zipFileName);
        $this->filesystem->remove(
            \sprintf('%s/json-ld-api-main', self::CACHE_DIR_W3C_TEST_SUITE),
        );
    }

    public function getSchemaOrgTypesDefinition(): string
    {
        $filename = $this->getSchemaOrgTypesDefinitionFilename();

        if (!$this->hasSchemaOrgTypesDefinitionFile()) {
            throw new IOException(\sprintf('Failed to read file "%s": ', $filename), 0, null, $filename);
        }

        return file_get_contents($filename);
    }

    private function getSchemaOrgTypesDefinitionFilename(): string
    {
        return \sprintf(
            '%s/schemaorg-%s-https.jsonld',
            self::CACHE_DIR_SCHEMA_ORG,
            Extractor::CURRENT_VERSION,
        );
    }
}
