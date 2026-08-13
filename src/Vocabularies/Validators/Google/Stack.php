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
    public const BASE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google';

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

            $validationProperties = ValidationPropertiesNormalizer::normalizeProperties($validationProperties);

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

            ValidationPropertiesNormalizer::handleSpecialProperties($type, $validationType);

            $validationType['properties'] = ValidationPropertiesNormalizer::normalizeProperties($validationType['properties'] ?? []);
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

            $properties = ValidationPropertiesNormalizer::getNormalizedClassProperties($childValidationClass);
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
