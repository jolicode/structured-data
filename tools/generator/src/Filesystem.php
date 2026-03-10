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

use Jolicode\Vocabularies\SchemaOrg;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

readonly class Filesystem
{
    public const CACHE_DIR_SCHEMA_ORG = __DIR__ . '/../../../var/cache/schema-org';
    public const SCHEMA_ORG_EXAMPLES_DIR = __DIR__ . '/../../../resources/schema.org/examples';
    public const SCHEMA_ORG_FIXTURES_DIR = __DIR__ . '/../../../tests/Validation/fixtures/schema-org';
    private const GENERATED_CLASSES_DIR = __DIR__ . '/../../../src/Vocabularies/Generated';

    public function __construct(
        private SymfonyFilesystem $filesystem = new SymfonyFilesystem(),
    ) {
    }

    public function hasSchemaOrgTypesDefinitionFile(): bool
    {
        return $this->filesystem->exists(
            $this->getSchemaOrgTypesDefinitionFilename(),
        );
    }

    public function saveSchemaOrgClass(string $type, string $className, string $content): void
    {
        $this->filesystem->dumpFile(\sprintf(
            '%s/%s/%s.php',
            self::GENERATED_CLASSES_DIR . '/SchemaOrg',
            $type,
            $className,
        ), $content);
    }

    public function saveSchemaOrgExample(string $prefix, string $content): void
    {
        if (json_decode($content)) {
            $key = md5($content);
            $filename = \sprintf(
                '%s/%s-%s.jsonld',
                self::SCHEMA_ORG_EXAMPLES_DIR,
                $prefix,
                $key,
            );

            $this->filesystem->dumpFile($filename, $content);
        }
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
            SchemaOrg::VERSION,
        );
    }
}
