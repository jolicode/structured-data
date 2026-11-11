<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg;

use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

class Filesystem extends SymfonyFilesystem
{
    public const CACHE_DIR_SCHEMA_ORG = __DIR__ . '/../../var/cache/schema-org';
    public const SCHEMA_ORG_DIR = __DIR__ . '/../../resources/schema.org';
    public const SCHEMA_ORG_EXAMPLES_DIR = self::SCHEMA_ORG_DIR . '/examples';
    public const SCHEMA_ORG_FIXTURES_DIR = __DIR__ . '/../../tests/Validation/fixtures/schema-org';

    private const GENERATED_CLASSES_DIR = __DIR__ . '/../../src/Vocabularies/Generated';

    public function hasSchemaOrgTypesDefinitionFile(): bool
    {
        return $this->exists(
            $this->getSchemaOrgTypesDefinitionFilename(),
        );
    }

    public function saveSchemaOrgClass(string $type, string $className, string $content): void
    {
        $this->dumpFile(\sprintf(
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

            $this->dumpFile($filename, $content);
        }
    }

    public function getSchemaOrgTypesDefinition(): string
    {
        return $this->readCachedFile($this->getSchemaOrgTypesDefinitionFilename());
    }

    public function hasSchemaOrgContextFile(): bool
    {
        return $this->exists(
            $this->getSchemaOrgContextFilename(),
        );
    }

    /**
     * The JSON-LD context schema.org publishes along with each release: the one a JSON-LD
     * processor gets when it resolves "@context": "https://schema.org".
     */
    public function getSchemaOrgContext(): string
    {
        return $this->readCachedFile($this->getSchemaOrgContextFilename());
    }

    public function getSchemaOrgTypesDefinitionFilename(): string
    {
        return \sprintf(
            '%s/schemaorg-%s-https.jsonld',
            self::CACHE_DIR_SCHEMA_ORG,
            SchemaOrg::VERSION,
        );
    }

    public function getSchemaOrgContextFilename(): string
    {
        return \sprintf(
            '%s/schemaorg-%s-context.jsonld',
            self::CACHE_DIR_SCHEMA_ORG,
            SchemaOrg::VERSION,
        );
    }

    private function readCachedFile(string $filename): string
    {
        if (!$this->exists($filename)) {
            throw new IOException(\sprintf('Failed to read file "%s": ', $filename), 0, null, $filename);
        }

        $content = file_get_contents($filename);

        if (false === $content) {
            throw new IOException(\sprintf('Failed to read file "%s": ', $filename), 0, null, $filename);
        }

        return $content;
    }
}
