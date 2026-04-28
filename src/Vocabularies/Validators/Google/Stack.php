<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google;

use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Mapper\MappedType;

class Stack
{
    private const BASE_NAMESPACE = 'Jolicode\\Vocabularies\\Generated\\Google';

    public function __construct(
        private ?MappedType $currentType = null,
        private ?string $validationClass = null,
    ) {
    }

    public function newType(MappedType $type): self
    {
        if (null === $type->parentProperty) {
            $this->initialize($type);
        }

        $this->currentType = $type;

        return $this;
    }

    public function newProperty(MappedProperty $property): self
    {
        $this->currentType = $property->type;

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
        if (!$this->currentType->parentProperty) {
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

        return isset($validationType['properties'])
            ? $this->normalizeProperties($validationType['properties'])
            : null;
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
        if (!$this->currentType->parentProperty) {
            if (null === $this->validationClass) {
                return null;
            }

            return $this->validationClass::PROPERTIES[$propertyKey] ?? null;
        }

        $validationType = $this->resolveValidationType();

        if (!isset($validationType['properties'])) {
            return null;
        }

        $properties = $this->normalizeProperties($validationType['properties']);

        return $properties[$propertyKey] ?? null;
    }

    private function initialize(MappedType $type): self
    {
        $validationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $type->type);

        if (!class_exists($validationClass)) {
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

        $path = $this->buildPathToCurrentType();

        $validationProperties = $this->validationClass::PROPERTIES;
        $validationType = null;

        foreach ($path as $segment) {
            $searchedKey = $segment['propertyKey'];
            $type = $segment['type'];

            $validationProperties = $this->normalizeProperties($validationProperties);

            $validationType = $validationProperties[$searchedKey] ?? null;

            if (null === $validationType) {
                return null;
            }

            if ($this->isADataType($validationType)) {
                return $validationType;
            }

            $this->handleSpecialProperties($type, $validationType);

            $validationProperties = $validationType['properties'] ?? [];
        }

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
        $presentPropertyKeys = array_keys($type->properties);

        foreach ($parentValidationClass::CHILDREN as $child) {
            $childValidationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $child);

            if (!class_exists($childValidationClass) || !\defined($childValidationClass . '::PROPERTIES')) {
                continue;
            }

            $properties = $this->normalizeProperties($childValidationClass::PROPERTIES);
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
     * Builds the full parent chain from the current type by walking up all its parent properties.
     *
     * @return array<array{propertyKey: string, type: MappedType}>
     */
    private function buildPathToCurrentType(): array
    {
        /** @var MappedType $type */
        $type = $this->currentType;
        $path = [];

        while ($parentProperty = $type->parentProperty) {
            $path[] = [
                'propertyKey' => $parentProperty->key,
                'type' => $type,
            ];

            $type = $parentProperty->type;
        }

        return array_reverse($path);
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
            if (str_starts_with($supportedType, '@')) {
                $importFailed = true;
                $validationClass = $this->getImportedClass($supportedType);

                $matchingTypes = array_intersect(
                    (array) $mappedType->type,
                    $validationClass::SUPPORTED_TYPES,
                );

                foreach ($matchingTypes as $victory) {
                    $validationType['properties'] = array_merge(
                        $validationType['properties'] ?? [],
                        $validationClass::PROPERTIES,
                    );
                }

                return;
            }
        }

        // It should have already returned
        if (isset($importFailed)) {
            throw new \RuntimeException('A validation class import was requested but none of the supported types matched the requested type(s).');
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
            if (\in_array($target['@target'], (array) $mappedType->type, true)) {
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

        if (!class_exists($validationClass)) {
            throw new \RuntimeException(\sprintf('The "%s" Google validation class was requested, but the class doesn\'t exist. There is probably an issue with the hand-written json files.', $validationClass));
        }

        return $validationClass;
    }

    private function isADataType(array $testedType): bool
    {
        return (bool) array_intersect($testedType['supportedTypes'], GoogleValidator::DATA_TYPES);
    }
}
