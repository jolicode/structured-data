<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\Google;

use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

/**
 * Normalizes the hand-written Google validation property maps: flattens the
 * list-style entries, and expands the "@" imports and "@target" blocks that apply
 * to the audited type.
 *
 * The shapes below describe the PROPERTIES constant of the generated Google
 * validation classes: a property definition, or a block of definitions that only
 * applies to one of the types a property supports.
 *
 * @phpstan-type ValidationProperty array{
 *     name: string,
 *     severity: 'required'|'recommended'|'optional',
 *     supportedTypes: list<string>,
 *     documentation?: string,
 *     value?: list<string>|array<string, true>,
 *     properties?: array<mixed>,
 * }
 * @phpstan-type TargetBlock array{'@target': string, properties: array<mixed>, documentation?: string}
 * @phpstan-type ValidationProperties array<array-key, ValidationProperty|TargetBlock>
 */
final class ValidationPropertiesNormalizer
{
    /**
     * @var array<string, ValidationProperties>
     */
    private static array $normalizedPropertiesByClass = [];

    /**
     * Normalize the only two supported property shapes:
     * - a regular associative property map
     * - a list of blocks, where each block is either a plain property map or an @target block
     *
     * @param array<mixed> $properties
     *
     * @return ValidationProperties
     */
    public static function normalizeProperties(array $properties): array
    {
        $normalized = [];

        foreach ($properties as $key => $value) {
            if (!\is_array($value)) {
                continue;
            }

            if (\array_key_exists('@target', $value)) {
                $normalized[$key] = $value;

                continue;
            }

            if (\is_string($key)) {
                $normalized[$key] = $value;

                continue;
            }

            // List entries are supported only for the Book-style @target structure,
            // where each entry is either a dedicated @target block or a plain map
            // of base properties.
            foreach ($value as $nestedKey => $nestedValue) {
                if (!\is_string($nestedKey) || !\is_array($nestedValue)) {
                    continue;
                }

                $normalized[$nestedKey] = $nestedValue;
            }
        }

        // The entries come from the generated validation classes, whose shape is
        // guaranteed by the generator.
        /** @var ValidationProperties $validationProperties */
        $validationProperties = $normalized;

        return $validationProperties;
    }

    /**
     * The nested property definitions of a validation property, once normalized.
     *
     * @param ValidationProperty|TargetBlock $validationType
     *
     * @return ValidationProperties
     */
    public static function nestedProperties(array $validationType): array
    {
        /** @var ValidationProperties $properties */
        $properties = $validationType['properties'] ?? [];

        return $properties;
    }

    /**
     * @return ValidationProperties
     */
    public static function getNormalizedClassProperties(string $validationClass): array
    {
        if (isset(self::$normalizedPropertiesByClass[$validationClass])) {
            return self::$normalizedPropertiesByClass[$validationClass];
        }

        return self::$normalizedPropertiesByClass[$validationClass] = self::normalizeProperties($validationClass::PROPERTIES);
    }

    /**
     * @param ValidationProperty|TargetBlock $validationType
     */
    public static function handleSpecialProperties(MappedType $mappedType, array &$validationType): void
    {
        self::setImportedProperties($mappedType, $validationType);
        self::setTargettedProperties($mappedType, $validationType);
    }

    /**
     * @param ValidationProperty|TargetBlock $validationType
     */
    private static function setImportedProperties(MappedType $mappedType, array &$validationType): void
    {
        foreach ($validationType['supportedTypes'] ?? [] as $supportedType) {
            if (!str_starts_with($supportedType, '@')) {
                continue;
            }

            $validationClass = self::getImportedClass($supportedType);

            $matchingTypes = array_intersect(
                (array) $mappedType->getType(),
                $validationClass::SUPPORTED_TYPES,
            );

            // A mismatch is not an authoring error of the validation spec: it happens
            // whenever the audited document nests an unexpected type where the import
            // is declared (e.g. a Person under Answer.comment, which imports @Comment).
            // In that case there simply is nothing to import, and the document must
            // keep being validated - never crash the audit.
            if ([] !== $matchingTypes) {
                $validationType['properties'] = array_merge(
                    $validationType['properties'] ?? [],
                    $validationClass::PROPERTIES,
                );
            }

            return;
        }
    }

    // This method "loads" the targetted validation properties needed for the requested type
    // Targetted validation properties are properties that validate only a single type of a property (the target) while this property supports several types.
    /**
     * @param ValidationProperty|TargetBlock $validationType
     */
    private static function setTargettedProperties(MappedType $mappedType, array &$validationType): void
    {
        if (!isset($validationType['properties'])) {
            return;
        }

        foreach ($validationType['properties'] as $target) {
            if (!\is_array($target) || !\array_key_exists('@target', $target)) {
                continue;
            }

            if (\in_array($target['@target'], (array) $mappedType->getType(), true)) {
                $validationType['properties'] = array_merge(
                    $validationType['properties'],
                    (array) ($target['properties'] ?? []),
                );
            }
        }
    }

    private static function getImportedClass(string $importedType): string
    {
        $validationClass = str_replace('@', '', $importedType);
        $validationClass = \sprintf('%s\\%s', Stack::BASE_NAMESPACE, $validationClass);

        if (!GeneratedClassesRegistry::has($validationClass)) {
            throw new \RuntimeException(\sprintf('The "%s" Google validation class was requested, but the class doesn\'t exist. There is probably an issue with the hand-written json files.', $validationClass));
        }

        return $validationClass;
    }
}
