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
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrgTypeHierarchy;

/**
 * Finds the Google validation rules that apply to the type being validated.
 *
 * A root type is validated by the class named after it, or after its nearest
 * schema.org ancestor when Google documents the subtypes through their parent
 * (a BusinessEvent is an Event, a Restaurant a LocalBusiness). A nested type is
 * validated by the rules its parent documents for the property it sits in; when
 * the parent documents no such property, the nested type starts over as a root
 * if Google documents its type as a rich result of its own, as Google does with
 * every entity of the page, wherever it is nested.
 *
 * @phpstan-import-type ValidationProperty from ValidationPropertiesNormalizer
 * @phpstan-import-type ValidationProperties from ValidationPropertiesNormalizer
 * @phpstan-import-type TargetBlock from ValidationPropertiesNormalizer
 *
 * @phpstan-type Resolution array{class: ?string, standalone: bool, validationType: ValidationProperty|TargetBlock|null}
 */
class Stack
{
    public const BASE_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google';

    private ?string $resolutionCacheKey = null;

    /** @var Resolution|null */
    private ?array $resolutionCache = null;

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

    /**
     * The validation class whose rules apply to the current type: the one of the
     * root, or the one the current type (or one of its ancestors in the document)
     * started over with.
     */
    public function getValidationClass(): ?string
    {
        if (null === $this->currentType || null === $this->currentType->getParentProperty()) {
            return $this->validationClass;
        }

        return $this->resolve()['class'];
    }

    /**
     * Return all the validation properties of the current type, or null if the
     * current type is a Data Type, or if the current type is not a type supported
     * by the Google vocabulary.
     * Used to validate a type.
     *
     * @return ValidationProperties|null
     */
    public function getTypeValidationProperties(): ?array
    {
        $resolution = $this->resolve();

        if ($resolution['standalone']) {
            return null === $resolution['class'] ? null : $resolution['class']::PROPERTIES;
        }

        $validationType = $resolution['validationType'];

        // Data Types are handled when we validate properties
        if (!$validationType || $this->isADataType($validationType)) {
            return null;
        }

        if (!isset($validationType['properties'])) {
            return null;
        }

        return ValidationPropertiesNormalizer::nestedProperties($validationType);
    }

    /**
     * Return the full definition of a child property of the current type by its
     * key, or null if the property was not found.
     * Used to validate a property.
     *
     * @return ValidationProperty|TargetBlock|null
     */
    public function getNextValidationProperty(string $propertyKey): ?array
    {
        $resolution = $this->resolve();

        if ($resolution['standalone']) {
            return null === $resolution['class'] ? null : ($resolution['class']::PROPERTIES[$propertyKey] ?? null);
        }

        $validationType = $resolution['validationType'];

        if (!isset($validationType['properties'])) {
            return null;
        }

        return ValidationPropertiesNormalizer::nestedProperties($validationType)[$propertyKey] ?? null;
    }

    /**
     * Whether the rules of a validation class apply to the given subtype of the
     * type it is named after.
     */
    public static function acceptsSubtype(string $validationClass, string $typeLabel): bool
    {
        if (\defined($validationClass . '::ACCEPTS_SUBTYPES') && !$validationClass::ACCEPTS_SUBTYPES) {
            return false;
        }

        if (\defined($validationClass . '::EXCLUDED_SUBTYPES') && SchemaOrgTypeHierarchy::isA($typeLabel, $validationClass::EXCLUDED_SUBTYPES)) {
            return false;
        }

        return true;
    }

    private function initialize(MappedType $type): self
    {
        $this->resetResolutionCache();
        $this->validationClass = $this->resolveValidationClassFor($type);

        return $this;
    }

    /**
     * Resolves the rules of the current type by walking down from the root: at each
     * property of the path, the definition the parent documents for it, or, when
     * there is none, a fresh start from the class of the nested type.
     *
     * @return Resolution
     */
    private function resolve(): array
    {
        $currentType = $this->getCurrentType();

        if (null === $currentType->getParentProperty()) {
            return ['class' => $this->validationClass, 'standalone' => true, 'validationType' => null];
        }

        $cacheKey = $this->getResolutionCacheKey();

        if ($cacheKey === $this->resolutionCacheKey && null !== $this->resolutionCache) {
            return $this->resolutionCache;
        }

        $class = $this->validationClass;
        $definitions = null === $class ? null : $class::PROPERTIES;
        $standalone = false;
        $validationType = null;

        foreach ($this->buildPathToCurrentType() as $segment) {
            $validationType = null === $definitions
                ? null
                : (ValidationPropertiesNormalizer::normalizeProperties($definitions)[$segment['propertyKey']] ?? null);

            if (null === $validationType) {
                // The parent documents nothing for this property (or is not documented
                // itself): Google still treats the nested entity as a rich result of its
                // own when it documents its type as one.
                $class = $this->resolveStandaloneValidationClassFor($segment['type']);
                $standalone = null !== $class;
                $definitions = null === $class ? null : $class::PROPERTIES;

                continue;
            }

            $standalone = false;

            if ($this->isADataType($validationType)) {
                $definitions = null;

                continue;
            }

            ValidationPropertiesNormalizer::handleSpecialProperties($segment['type'], $validationType);

            $validationType['properties'] = ValidationPropertiesNormalizer::normalizeProperties($validationType['properties'] ?? []);
            $definitions = $validationType['properties'];
        }

        $this->resolutionCacheKey = $cacheKey;

        return $this->resolutionCache = [
            'class' => $class,
            'standalone' => $standalone,
            'validationType' => $validationType,
        ];
    }

    /**
     * The validation class of a type taken on its own: the class named after the
     * type or after its nearest schema.org ancestor, narrowed down to the child
     * class matching the payload when the class has several.
     */
    private function resolveValidationClassFor(MappedType $type): ?string
    {
        // A multi-typed entry is validated once per type, through single-typed
        // clones; the original, still multi-typed, is what the path to a nested
        // type goes through, and the first of its types that Google documents
        // tells which rules the nested type is reached by.
        foreach ((array) $type->getType() as $typeLabel) {
            $validationClass = $this->findValidationClass($typeLabel);

            if (null === $validationClass) {
                continue;
            }

            if (\defined($validationClass . '::CHILDREN')) {
                return $this->resolveChildValidationClass($type, $validationClass);
            }

            if (\defined($validationClass . '::PROPERTIES')) {
                return $validationClass;
            }
        }

        return null;
    }

    /**
     * Same as resolveValidationClassFor(), for a type found nested where its
     * parent documents nothing: only the types Google reports as rich results of
     * their own apply there, not the ones that only exist within another type.
     */
    private function resolveStandaloneValidationClassFor(MappedType $type): ?string
    {
        $validationClass = $this->resolveValidationClassFor($type);

        if (null === $validationClass) {
            return null;
        }

        if (\defined($validationClass . '::STANDALONE') && !$validationClass::STANDALONE) {
            return null;
        }

        return $validationClass;
    }

    /**
     * The class named after the type, or after the nearest of its schema.org
     * ancestors whose class accepts subtypes, this one not being excluded.
     */
    private function findValidationClass(string $typeLabel): ?string
    {
        foreach (SchemaOrgTypeHierarchy::selfAndAncestors($typeLabel) as $index => $label) {
            $validationClass = \sprintf('%s\\%s', self::BASE_NAMESPACE, $label);

            if (!GeneratedClassesRegistry::has($validationClass)) {
                continue;
            }

            if (0 === $index || self::acceptsSubtype($validationClass, $typeLabel)) {
                return $validationClass;
            }

            return null;
        }

        return null;
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

    /**
     * @param ValidationProperty|TargetBlock $testedType
     */
    private function isADataType(array $testedType): bool
    {
        // A property may accept either a data type or a structured type ("Text or
        // CategoryCode"). The stack only reaches it through an object, so the nested
        // properties defined for the structured type still apply.
        if (isset($testedType['@target']) || isset($testedType['properties'])) {
            return false;
        }

        return (bool) array_intersect($testedType['supportedTypes'], DataTypeChecker::DATA_TYPES);
    }

    private function getResolutionCacheKey(): string
    {
        return $this->validationClass . '|' . spl_object_id($this->getCurrentType());
    }

    private function resetResolutionCache(): void
    {
        $this->resolutionCacheKey = null;
        $this->resolutionCache = null;
    }
}
