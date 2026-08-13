<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

/**
 * Translates between the expanded schema.org IRIs and the short, author-facing
 * labels the mapped structure exposes, and normalizes their casing.
 */
final class SchemaOrgNameNormalizer
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';
    private const SCHEMA_ORG_DOMAIN_SECURE = 'https://schema.org/';

    private const GENERATED_SCHEMA_ORG_TYPE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type';
    private const GENERATED_GOOGLE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google';

    /**
     * @var array<string, string>|null
     */
    private static ?array $knownTypeNamesByLowercase = null;

    /**
     * @var array<string, string>
     */
    private array $strippedSchemaOrgDomainCache = [];

    /**
     * @var array<string, string>
     */
    private array $normalizedTypeLabelCache = [];

    public function reset(): void
    {
        $this->strippedSchemaOrgDomainCache = [];
        $this->normalizedTypeLabelCache = [];
    }

    /**
     * Since we are expanding the user input, all properties will be prefixed with the schema.org domain.
     * This is not really frontend friendly, plus users would not necessarilly understand why their input has changed.
     * For these reasons, we strip the schema.org domain from the properties keys.
     */
    public function removeSchemaOrgDomain(string ...$typesEntry): string|array
    {
        if (1 === \count($typesEntry)) {
            return $this->stripSchemaOrgDomain($typesEntry[0]);
        }

        $typeShortNames = [];

        foreach ($typesEntry as $typeName) {
            $typeShortNames[] = $this->stripSchemaOrgDomain($typeName);
        }

        return $typeShortNames;
    }

    public function normalizeTypeLabelCase(string $typeName): string
    {
        return $this->normalizedTypeLabelCache[$typeName] ??= self::getKnownTypeNamesByLowercase()[strtolower($typeName)] ?? $typeName;
    }

    public function normalizePropertyKeyCase(string $propertyKey): string
    {
        $first = $propertyKey[0];

        // Fast-exit for lowercase/non-alpha first char (most schema.org props) and '@' keywords
        if ($first < 'A' || $first > 'Z') {
            return $propertyKey;
        }

        // Starts with uppercase ASCII
        if (strtoupper($propertyKey) === $propertyKey) {
            return strtolower($propertyKey);
        }

        return lcfirst($propertyKey);
    }

    public function appendSchemaOrgDomain(string $property): string
    {
        return self::SCHEMA_ORG_DOMAIN . $property;
    }

    private function stripSchemaOrgDomain(string $typeName): string
    {
        if (isset($this->strippedSchemaOrgDomainCache[$typeName])) {
            return $this->strippedSchemaOrgDomainCache[$typeName];
        }

        if (str_starts_with($typeName, self::SCHEMA_ORG_DOMAIN)) {
            return $this->strippedSchemaOrgDomainCache[$typeName] = substr($typeName, \strlen(self::SCHEMA_ORG_DOMAIN));
        }

        if (str_starts_with($typeName, self::SCHEMA_ORG_DOMAIN_SECURE)) {
            return $this->strippedSchemaOrgDomainCache[$typeName] = substr($typeName, \strlen(self::SCHEMA_ORG_DOMAIN_SECURE));
        }

        return $this->strippedSchemaOrgDomainCache[$typeName] = $typeName;
    }

    /**
     * @return array<string, string>
     */
    private static function getKnownTypeNamesByLowercase(): array
    {
        if (self::$knownTypeNamesByLowercase) {
            return self::$knownTypeNamesByLowercase;
        }

        self::$knownTypeNamesByLowercase = [];

        foreach (GeneratedClassesRegistry::getShortNamesByPrefix(self::GENERATED_SCHEMA_ORG_TYPE_NAMESPACE) as $shortName) {
            $typeName = str_replace('Model', '', $shortName);
            self::$knownTypeNamesByLowercase[strtolower($typeName)] = $typeName;
        }

        foreach (GeneratedClassesRegistry::getShortNamesByPrefix(self::GENERATED_GOOGLE_NAMESPACE) as $typeName) {
            self::$knownTypeNamesByLowercase[strtolower($typeName)] = $typeName;
        }

        return self::$knownTypeNamesByLowercase;
    }
}
