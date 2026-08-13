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

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ArrayStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;
use JoliCode\StructuredData\JsonLd\Parser\Properties\Property;
use JoliCode\StructuredData\JsonLd\Parser\Properties\Value;
use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel;

class ValidationMapper
{
    private string $sourceFormat;

    public function __construct(
        /**
         * @var array<string,MappedType>
         */
        public array $flattenedTypeReferences = [],
        /**
         * @var array<MappedType>
         */
        private array $mappedTypes = [],
        /**
         * @var array<MappedError>
         */
        private array $mappedErrors = [],
        /**
         * @var array<string,MappedProperty>
         */
        private array $propertiesWithReferences = [],
        /**
         * @var array<int, string>
         */
        private array $propertyReferenceByObjectId = [],
        private ?ObjectStructure $rootParsedJsonLd = null,
        private readonly SchemaOrgNameNormalizer $nameNormalizer = new SchemaOrgNameNormalizer(),
    ) {
    }

    public function reset(): void
    {
        $this->mappedTypes = [];
        $this->mappedErrors = [];
        $this->flattenedTypeReferences = [];
        $this->propertiesWithReferences = [];
        $this->propertyReferenceByObjectId = [];
        $this->rootParsedJsonLd = null;
        $this->nameNormalizer->reset();
    }

    /**
     * @return array<MappedError>
     */
    public function getMappedErrors(): array
    {
        return $this->mappedErrors;
    }

    /**
     * @return array<MappedType>
     */
    public function map(array $expandedJsonLd, ObjectStructure $parsedJsonLd, string $sourceFormat): array
    {
        $this->rootParsedJsonLd = $parsedJsonLd;
        $this->sourceFormat = $sourceFormat;

        foreach ($expandedJsonLd as $expandedType) {
            $mappedType = $this->mapType($expandedType);

            if (
                !property_exists($expandedType, Keyword::ID->value)
                || (!$this->isTypeReference($expandedType)
                    || '_:b0' === $expandedType->{Keyword::ID->value})
            ) {
                $this->mappedTypes[] = $mappedType;
            }
        }

        $this->mapFlattenedTypes();

        foreach ($this->mappedTypes as $type) {
            $this->addRangesToType($type, $parsedJsonLd);
        }

        unset($this->propertiesWithReferences);

        return $this->mappedTypes;
    }

    private function mapType(\stdClass $expandedType): MappedType
    {
        $type = new MappedType(sourceFormat: $this->sourceFormat);

        if (property_exists($expandedType, Keyword::TYPE->value)) {
            $types = $this->nameNormalizer->removeSchemaOrgDomain(...(array) $expandedType->{Keyword::TYPE->value});
            $normalizedTypes = [];

            foreach ((array) $types as $mappedType) {
                $normalizedTypes[] = $this->nameNormalizer->normalizeTypeLabelCase($mappedType);
            }

            $type->setType($normalizedTypes);
        }

        $nameProperty = null;

        if (property_exists($expandedType, 'http://schema.org/name')) {
            $nameProperty = $expandedType->{'http://schema.org/name'}[0];
        } elseif (property_exists($expandedType, 'https://schema.org/name')) {
            $nameProperty = $expandedType->{'https://schema.org/name'}[0];
        }

        if (null !== $nameProperty && property_exists($nameProperty, Keyword::VALUE->value)) {
            $type->setName($nameProperty->{Keyword::VALUE->value});
        }

        foreach ($expandedType as $label => $value) {
            if (
                Keyword::ID->value === $label
                && IriResolver::isBlankNodeIdentifier($value)
            ) {
                $this->saveFlattenedTypeReference($value, $type);
            }

            if (null !== $value) {
                if ('@' === ($label[0] ?? '')) {
                    $propertyKey = $label;
                } else {
                    $propertyKey = $this->nameNormalizer->normalizePropertyKeyCase($this->nameNormalizer->removeSchemaOrgDomain($label));
                }

                $type->setProperty($propertyKey, $this->mapProperty($value, $propertyKey, $type));
            }
        }

        return $type;
    }

    private function mapProperty(mixed $value, string $key, MappedType $type): MappedProperty
    {
        $property = new MappedProperty($key, $type);
        $isTypeKeywordProperty = Keyword::TYPE->value === $key;

        if (\is_string($value) || \is_int($value)) {
            $property->setValue($value);

            return $property;
        }

        foreach ($value as $valueKey => $valueEntry) {
            if (\is_array($valueEntry)) {
                $valueEntry = (object) $valueEntry;
            }

            if ($valueEntry instanceof \stdClass) {
                if ($this->isTypeReference($valueEntry)) {
                    $this->savePropertyWithReference($valueEntry, $property);
                }

                if ($this->isTypeProperty($valueEntry)) {
                    if (Keyword::REVERSE->value === $key) {
                        foreach ($valueEntry as $reverseValue) {
                            $property->appendValue($this->createPropertyType($reverseValue, $property));
                        }

                        continue;
                    }

                    $valueEntry = $this->createPropertyType($valueEntry, $property);
                }

                if ($this->isValueOrId($valueEntry)) {
                    $valueEntry = $valueEntry->{Keyword::VALUE->value} ?? ($valueEntry->{Keyword::ID->value} ?? null);
                }
            }

            if ($isTypeKeywordProperty && \is_string($valueEntry)) {
                $valueEntry = $this->nameNormalizer->removeSchemaOrgDomain($valueEntry);
            }

            if (\is_string($valueKey)) {
                if ('@' === ($valueKey[0] ?? '')) {
                    $property->appendValue($valueEntry, $valueKey);

                    continue;
                }

                $valueKey = $this->nameNormalizer->removeSchemaOrgDomain($valueKey);
                $valueKey = $this->nameNormalizer->normalizePropertyKeyCase($valueKey);
                $property->appendValue($valueEntry, $valueKey);
            } else {
                $property->appendValue($valueEntry);
            }
        }

        $propertyValue = $property->getValue();

        if (\is_array($propertyValue) && 1 === \count($propertyValue)) {
            $propertyValue = $propertyValue[0];

            if ($this->isValueOrId($propertyValue)) {
                $property->setValue($this->retrieveValueOrId($propertyValue));
            } else {
                $property->setValue($propertyValue);
            }
        }

        return $property;
    }

    private function addRangesToType(MappedType $type, AbstractStructure $parsedJsonLd): void
    {
        if ($parsedJsonLd instanceof ObjectStructure) {
            if ($parsedJsonLd->hasAGraph()) {
                $identifier = array_search($type, $this->flattenedTypeReferences, true);

                if ($identifier) {
                    $parsedJsonLd = $parsedJsonLd->getGraphValue($identifier)->content;
                } elseif (\count($this->flattenedTypeReferences)) {
                    // Framed algorithm doesnt set an @id entry for the first element of the graph, but it does for every other entries of the graph.
                    // Hence it is safe to get the first graph entry: for other entries, $identifier will evaluate to true.
                    $parsedJsonLd = $parsedJsonLd->getGraphType(0);
                } else {
                    // @graph is supposed to only be used with the flattened and the framed algorithms, which all use type references.
                    // Turns out, other formats may aswell! In those cases, the real type may be safely retrieved from the map directly. There are no references.
                    $graphIndex = array_search($type, $this->mappedTypes, \true);

                    if (\is_int($graphIndex)) {
                        $parsedJsonLd = $parsedJsonLd->getGraphType($graphIndex);
                    }
                }
            }

            if ($this->rootParsedJsonLd instanceof ObjectStructure && $this->isParsedFlattenedTypeReference($parsedJsonLd)) {
                $identifier = $parsedJsonLd->getProperty(Keyword::ID->value)->value->content;
                $parsedJsonLd = $this->rootParsedJsonLd->getGraphValue($identifier)->content;
            }

            $type->addValueRange($parsedJsonLd->range);
            $this->setOriginalTypeFromParsedJsonLd($type, $parsedJsonLd);
            $type->setDuplicateKeys($parsedJsonLd->getDuplicateKeys());
        }

        $properties = $type->getProperties();

        if ($parsedJsonLd instanceof ObjectStructure) {
            foreach ($properties as $property) {
                $this->addRangesToProperty($property, $parsedJsonLd);
            }
        } elseif ($parsedJsonLd instanceof ArrayStructure) {
            array_map(
                fn (Value $value) => $value->content instanceof AbstractStructure && $this->addRangesToType($type, $value->content),
                $parsedJsonLd->getValues(),
            );
        }
    }

    private function addRangesToProperty(MappedProperty $property, ObjectStructure $parsedJsonLd): void
    {
        $parsedValue = $this->retrieveParsedValue($property, $parsedJsonLd);

        if (!$parsedValue instanceof Property) {
            return;
        }

        // A Value may be found on an array and have no key.
        $parsedKey = $parsedValue->key;
        $parsedValue = $parsedValue->value;

        if (null === $parsedValue) {
            return;
        }

        $property->setOriginalKey($parsedKey->name);
        $property->addKeyRange($parsedKey->range);
        $property->addValueRange($parsedValue->range);

        if (IriResolver::isBlankNodeIdentifier($parsedValue->content)) {
            return;
        }

        $propertyValue = $property->getValue();

        if ($propertyValue instanceof MappedType) {
            // When a date is encountered during expansion, it converted to a type. This is not the case on the original JSON-LD, it is only a string.
            if (\is_string($parsedValue->content) && DateModel::LABEL === $propertyValue->getType()) {
                $propertyValue->addKeyRange($parsedKey->range);
                $propertyValue->addValueRange($parsedValue->range);

                return;
            }

            if ($parsedValue->content instanceof AbstractStructure) {
                $this->addRangesToType($propertyValue, $parsedValue->content);
            }
        } elseif (\is_array($propertyValue) && $parsedValue->content instanceof ArrayStructure) {
            foreach ($propertyValue as $key => $value) {
                $content = $parsedValue->content->getValue($key)->content;

                if ($value instanceof MappedType && $content instanceof AbstractStructure) {
                    $this->addRangesToType($value, $content);
                }
            }
        }
    }

    private function setOriginalTypeFromParsedJsonLd(MappedType $type, ObjectStructure $parsedJsonLd): void
    {
        try {
            $parsedType = $parsedJsonLd->getProperty(Keyword::TYPE->value);
        } catch (\InvalidArgumentException) {
            return;
        }

        $parsedTypeValue = $parsedType->value?->content;

        if (\is_string($parsedTypeValue)) {
            $type->setOriginalType($parsedTypeValue);

            return;
        }

        if (!$parsedTypeValue instanceof ArrayStructure) {
            return;
        }

        $originalTypes = [];

        foreach ($parsedTypeValue->getValues() as $value) {
            if (\is_string($value->content)) {
                $originalTypes[] = $value->content;
            }
        }

        if (!$originalTypes) {
            return;
        }

        $type->setOriginalType(1 === \count($originalTypes) ? $originalTypes[0] : $originalTypes);
    }

    /**
     * Finding a property on an ObjectStructure is not that easy because its properties will follow the JSON-LD format the user provided.
     * So it may be in either of the compacted, expanded, flattened or framed formats. We have to check for every single one.
     */
    private function retrieveParsedValue(MappedProperty $property, ObjectStructure $parsedJsonLd): Property|Value|false
    {
        $shortPropertyKey = $property->getKey();
        $parsedProperties = $parsedJsonLd->getProperties();

        // Compacted
        if ($parsed = $parsedProperties[$shortPropertyKey] ?? null) {
            return $parsed;
        }

        if ('@' === ($shortPropertyKey[0] ?? '')) {
            return false;
        }

        $expandedPropertyKey = $this->nameNormalizer->appendSchemaOrgDomain($shortPropertyKey);

        // Expanded
        if ($parsed = $parsedProperties[$expandedPropertyKey] ?? null) {
            return $parsed;
        }

        foreach ($parsedProperties as $parsedProperty) {
            $parsedPropertyKey = $parsedProperty->key->name;

            if (
                $parsedPropertyKey === $shortPropertyKey
                || $parsedPropertyKey === $expandedPropertyKey
                || 0 === strcasecmp($parsedPropertyKey, $shortPropertyKey)
                || 0 === strcasecmp($parsedPropertyKey, $expandedPropertyKey)
            ) {
                return $parsedProperty;
            }
        }

        if ($this->rootParsedJsonLd instanceof ObjectStructure && $reference = $this->findPropertyReference($property)) {
            return $this->rootParsedJsonLd->getGraphValue($reference);
        }

        return false;
    }

    private function saveFlattenedTypeReference(string $identifier, MappedType $type): void
    {
        $this->flattenedTypeReferences[$identifier] = $type;
    }

    private function savePropertyWithReference(\stdClass $valueEntry, MappedProperty $property): void
    {
        if (\is_string($valueEntry->{Keyword::ID->value})) {
            $identifier = $valueEntry->{Keyword::ID->value};
            $this->propertiesWithReferences[$identifier] = $property;
            $this->propertyReferenceByObjectId[spl_object_id($property)] = $identifier;
        }
    }

    private function findPropertyReference(MappedProperty $property): ?string
    {
        return $this->propertyReferenceByObjectId[spl_object_id($property)] ?? null;
    }

    private function isParsedFlattenedTypeReference(AbstractStructure $type): bool
    {
        if (!$type instanceof ObjectStructure) {
            return false;
        }

        $properties = $type->getProperties();

        return 1 === \count($properties)
            && \array_key_exists('id', $properties)
            && IriResolver::isBlankNodeIdentifier($properties['id']->value?->content);
    }

    private function isTypeReference(\stdClass|MappedType|string $valueEntry): bool
    {
        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        $properties = get_object_vars($valueEntry);

        return 1 === \count($properties)
            && Keyword::ID->value === array_key_first($properties)
            && IriResolver::isBlankNodeIdentifier($valueEntry->{Keyword::ID->value});
    }

    private function getFlattenedTypeReference(string $identifier): MappedType
    {
        return $this->flattenedTypeReferences[$identifier];
    }

    private function mapFlattenedTypes(): void
    {
        foreach ($this->propertiesWithReferences as $property) {
            $propertyValue = $property->getValue();

            if (\is_string($propertyValue)) {
                $property->setValue($this->getFlattenedTypeReference($propertyValue));

                continue;
            }

            if (\is_array($propertyValue)) {
                $actualTypes = [];

                foreach ($propertyValue as $propertyTypeEntry) {
                    if ($propertyTypeEntry instanceof MappedType) {
                        $actualTypes = $propertyValue;

                        break;
                    }

                    $actualTypes[] = $this->getFlattenedTypeReference($propertyTypeEntry->{Keyword::ID->value});
                }

                $property->setValue($actualTypes);
            }
        }
    }

    private function isTypeProperty(\stdClass|array|string $valueEntry): bool
    {
        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        $properties = get_object_vars($valueEntry);

        if (1 === \count($properties)) {
            if (property_exists($valueEntry, Keyword::ID->value)) {
                return IriResolver::isBlankNodeIdentifier($valueEntry->{Keyword::ID->value});
            }

            if (property_exists($valueEntry, Keyword::VALUE->value)) {
                return false;
            }
        }

        return true;
    }

    private function createPropertyType(\stdClass $expandedType, MappedProperty $property): MappedType
    {
        $propertyType = $this->mapType($expandedType);
        $propertyType->setParent($property->getOwnerType());
        $propertyType->setParentProperty($property);

        return $propertyType;
    }

    private function isValueOrId(\stdClass|MappedType|string $valueEntry): bool
    {
        if ($valueEntry instanceof MappedType) {
            return false;
        }

        if (!$valueEntry instanceof \stdClass) {
            return false;
        }

        return property_exists($valueEntry, Keyword::VALUE->value)
            || property_exists($valueEntry, Keyword::ID->value);
    }

    /**
     * Both values will not be present at the same time.
     * Value is used for regular values, while ID is used for URIs.
     */
    private function retrieveValueOrId(\stdClass $basicProperty): string|int|float|bool|null
    {
        return $basicProperty->{Keyword::VALUE->value} ?? $basicProperty->{Keyword::ID->value};
    }
}
