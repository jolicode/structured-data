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

use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

class Stack
{
    private const BASE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google';

    /** @var array<string, array<mixed>> */
    private static array $normalizedPropertiesByClass = [];

    private ?string $resolvedValidationTypeCacheKey = null;
    private ?array $resolvedValidationTypeCache = null;

    public function __construct(
        private ?MappedType $currentType = null,
        private ?string $validationClass = null,
    ) {
    }

    public function newType(MappedType $type): self
    {
        if ($this->currentType && spl_object_id($this->currentType) === spl_object_id($type)) {
            return $this;
        }

        if (null === $type->getParentProperty()) {
            $this->initialize($type);
        }

        $this->currentType = $type;
        $this->resetResolutionCache();

        return $this;
    }

    public function newProperty(MappedProperty $property): self
    {
        $ownerType = $property->getOwnerType();

        if ($this->currentType && spl_object_id($this->currentType) === spl_object_id($ownerType ?? (object) [])) {
            return $this;
        }

        $this->currentType = $ownerType;
        $this->resetResolutionCache();

        return $this;
    }

    public function getValidationClass(): ?string
    {
        return $this->validationClass;
    }

    /**
     * Return all the validation properties of the current type.
     * Used to validate a type.
     *
     * @return array The validation properties found on the current type
     * @return null  if the current type is a Data Type, or if the current type is not a type supported by the Google vocabulary
     */
    public function getTypeValidationProperties(): ?array
    {
        $currentType = $this->getCurrentType();

        if (!$currentType->getParentProperty()) {
            if (null === $this->validationClass) {
                return null;
            }

            return $this->validationClass::PROPERTIES;
        }

        $validationType = $this->resolveValidationType();

        // Data Types are handled when we validate properties
        if (!$validationType || $this->isADataType($validationType)) {
            return null;
        }

        return $validationType['properties'] ?? null;
    }

    /**
     * Return the full definition of a child property of the current type by its key.
     * Used to validate a property.
     *
     * @return array The requested validation property found on the current type
     * @return null  If the property was not found
     */
    public function getNextValidationProperty(string $propertyKey): ?array
    {
        $currentType = $this->getCurrentType();

        if (!$currentType->getParentProperty()) {
            if (null === $this->validationClass) {
                return null;
            }

            return $this->validationClass::PROPERTIES[$propertyKey] ?? null;
        }

        $validationType = $this->resolveValidationType();

        if (!isset($validationType['properties'])) {
            return null;
        }

        $properties = $validationType['properties'];

        return $properties[$propertyKey] ?? null;
    }

    private function initialize(MappedType $type): self
    {
        $this->resetResolutionCache();
        $validationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $type->getType());

        if (!GeneratedClassesRegistry::has($validationClass)) {
            $this->validationClass = null;

            return $this;
        }

        if (\defined($validationClass . '::CHILDREN')) {
            $this->validationClass = $this->resolveChildValidationClass($type, $validationClass);

            return $this;
        }

        $this->validationClass = \defined($validationClass . '::PROPERTIES') ? $validationClass : null;

        return $this;
    }

    /**
     * Build the currently inspected validation type by walking up the parent chain and handling special properties.
     */
    private function resolveValidationType(): ?array
    {
        if (null === $this->validationClass) {
            return null;
        }

        $cacheKey = $this->getResolutionCacheKey();

        if ($cacheKey === $this->resolvedValidationTypeCacheKey) {
            return $this->resolvedValidationTypeCache;
        }

        $path = $this->buildPathToCurrentType();

        $validationProperties = $this->validationClass::PROPERTIES;
        $validationType = null;

        foreach ($path as $segment) {
            $searchedKey = $segment['propertyKey'];
            $type = $segment['type'];

            $validationProperties = $this->normalizeProperties($validationProperties);

            $validationType = $validationProperties[$searchedKey] ?? null;

            if (null === $validationType) {
                $this->resolvedValidationTypeCacheKey = $cacheKey;
                $this->resolvedValidationTypeCache = null;

                return null;
            }

            if ($this->isADataType($validationType)) {
                $this->resolvedValidationTypeCacheKey = $cacheKey;
                $this->resolvedValidationTypeCache = $validationType;

                return $validationType;
            }

            $this->handleSpecialProperties($type, $validationType);

            $validationType['properties'] = $this->normalizeProperties($validationType['properties'] ?? []);
            $validationProperties = $validationType['properties'];
        }

        $this->resolvedValidationTypeCacheKey = $cacheKey;
        $this->resolvedValidationTypeCache = $validationType;

        return $validationType;
    }

    /**
     * Select the child class that best matches the current payload.
     *
     * Criteria order:
     * 1. fewest missing required properties
     * 2. highest property overlap
     * 3. lexical class name (stable tie-breaker)
     */
    private function resolveChildValidationClass(MappedType $type, string $parentValidationClass): ?string
    {
        $candidates = [];
        $presentPropertyKeys = array_keys($type->getProperties());

        foreach ($parentValidationClass::CHILDREN as $child) {
            $childValidationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $child);

            if (!GeneratedClassesRegistry::has($childValidationClass) || !\defined($childValidationClass . '::PROPERTIES')) {
                continue;
            }

            $properties = $this->getNormalizedClassProperties($childValidationClass);
            $missingRequiredCount = 0;
            $matchedPropertiesCount = 0;

            foreach ($properties as $propertyKey => $propertyDefinition) {
                if (!\is_array($propertyDefinition)) {
                    continue;
                }

                $isAtLeastOneOf = 'atLeastOneOf' === ($propertyDefinition['name'] ?? null);
                $isPresent = \in_array($propertyKey, $presentPropertyKeys, true);

                if ($isAtLeastOneOf) {
                    $alternatives = array_keys($propertyDefinition['value'] ?? []);
                    $isPresent = [] !== array_intersect($alternatives, $presentPropertyKeys);
                }

                if ($isPresent) {
                    ++$matchedPropertiesCount;
                }

                if ('required' === ($propertyDefinition['severity'] ?? null) && !$isPresent) {
                    ++$missingRequiredCount;
                }
            }

            $candidates[] = [
                'class' => $childValidationClass,
                'missingRequiredCount' => $missingRequiredCount,
                'matchedPropertiesCount' => $matchedPropertiesCount,
            ];
        }

        if ([] === $candidates) {
            return null;
        }

        usort(
            $candidates,
            static function (array $a, array $b): int {
                if ($a['missingRequiredCount'] !== $b['missingRequiredCount']) {
                    return $a['missingRequiredCount'] <=> $b['missingRequiredCount'];
                }

                if ($a['matchedPropertiesCount'] !== $b['matchedPropertiesCount']) {
                    return $b['matchedPropertiesCount'] <=> $a['matchedPropertiesCount'];
                }

                return strcmp($a['class'], $b['class']);
            },
        );

        return $candidates[0]['class'];
    }

    /**
     * Normalize the only two supported property shapes:
     * - a regular associative property map
     * - a list of blocks, where each block is either a plain property map or an @target block
     *
     * @param array<mixed> $properties
     *
     * @return array<mixed>
     */
    private function normalizeProperties(array $properties): array
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

        return $normalized;
    }

    /**
     * @return array<mixed>
     */
    private function getNormalizedClassProperties(string $validationClass): array
    {
        if (isset(self::$normalizedPropertiesByClass[$validationClass])) {
            return self::$normalizedPropertiesByClass[$validationClass];
        }

        return self::$normalizedPropertiesByClass[$validationClass] = $this->normalizeProperties($validationClass::PROPERTIES);
    }

    /**
     * Builds the full parent chain from the current type by walking up all its parent properties.
     *
     * @return array<array{propertyKey: string, type: MappedType}>
     */
    private function buildPathToCurrentType(): array
    {
        $type = $this->getCurrentType();
        $path = [];

        while ($type && ($parentProperty = $type->getParentProperty())) {
            $path[] = [
                'propertyKey' => $parentProperty->getKey(),
                'type' => $type,
            ];

            $type = $parentProperty->getOwnerType();
        }

        return array_reverse($path);
    }

    private function getCurrentType(): MappedType
    {
        if (!$this->currentType) {
            throw new \RuntimeException('No current mapped type is set in validation stack.');
        }

        return $this->currentType;
    }

    // These methods handle the special cases. They will update the "properties" entry by importing new ones into it.
    // If multiple types are found on the MappedType, all the potentially needed properties are imported.
    private function handleSpecialProperties(MappedType $mappedType, array &$validationType): void
    {
        $this->setImportedProperties($mappedType, $validationType);
        $this->setTargettedProperties($mappedType, $validationType);
    }

    private function setImportedProperties(MappedType $mappedType, array &$validationType): void
    {
        foreach ($validationType['supportedTypes'] as $supportedType) {
            if (!str_starts_with($supportedType, '@')) {
                continue;
            }

            $validationClass = $this->getImportedClass($supportedType);

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
    private function setTargettedProperties(MappedType $mappedType, array &$validationType): void
    {
        if (!isset($validationType['properties']) || !\is_array($validationType['properties'])) {
            return;
        }

        $targets = array_filter(
            $validationType['properties'],
            static fn (array $value) => \array_key_exists('@target', $value),
            \ARRAY_FILTER_USE_BOTH,
        );

        foreach ($targets as $target) {
            if (\in_array($target['@target'], (array) $mappedType->getType(), true)) {
                $validationType['properties'] = array_merge(
                    $validationType['properties'] ?: [],
                    $target['properties'],
                );
            }
        }
    }

    private function getImportedClass(string $importedType): string
    {
        $validationClass = str_replace('@', '', $importedType);
        $validationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $validationClass);

        if (!GeneratedClassesRegistry::has($validationClass)) {
            throw new \RuntimeException(\sprintf('The "%s" Google validation class was requested, but the class doesn\'t exist. There is probably an issue with the hand-written json files.', $validationClass));
        }

        return $validationClass;
    }

    private function isADataType(array $testedType): bool
    {
        return (bool) array_intersect($testedType['supportedTypes'], DataTypeChecker::DATA_TYPES);
    }

    private function getResolutionCacheKey(): string
    {
        return $this->validationClass . '|' . spl_object_id($this->getCurrentType());
    }

    private function resetResolutionCache(): void
    {
        $this->resolvedValidationTypeCacheKey = null;
        $this->resolvedValidationTypeCache = null;
    }
}
