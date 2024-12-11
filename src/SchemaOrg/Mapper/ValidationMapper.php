<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Mapper;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\DataStructures\AbstractStructure;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\Properties\Property;
use Jolicode\JsonLd\Parser\Properties\Value;
use Jolicode\SchemaOrg\Type\DateModel;

class ValidationMapper
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';

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
        private ?ObjectStructure $rootParsedJsonLd = null,
    ) {
    }

    public function reset(): void
    {
        $this->mappedTypes = [];
        $this->mappedErrors = [];
        $this->flattenedTypeReferences = [];
        $this->propertiesWithReferences = [];
        $this->rootParsedJsonLd = null;
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
    public function map(array $expandedJsonLd, ObjectStructure $parsedJsonLd): array
    {
        $this->rootParsedJsonLd = $parsedJsonLd;

        foreach ($expandedJsonLd as $expandedType) {
            $mappedType = $this->mapType($expandedType);

            if (
                !property_exists($expandedType, Keyword::ID->value)
                || (!$this->isTypeReference($expandedType)
                    && '_:b0' === $expandedType->{Keyword::ID->value})
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

    /**
     * Since we are expanding the user input, all properties will be prefixed with the schema.org domain.
     * This is not really frontend friendly, plus users would not necessarilly understand why their input has changed.
     * For these reasons, we strip the schema.org domain from the properties keys.
     */
    public function removeSchemaOrgDomain(string ...$typesEntry): string|array
    {
        $typeShortNames = [];

        foreach ($typesEntry as $typeName) {
            $typeShortNames[] = str_replace(self::SCHEMA_ORG_DOMAIN, '', $typeName);
        }

        return 1 === \count($typeShortNames) ? $typeShortNames[0] : $typeShortNames;
    }

    private function mapType(\stdClass $expandedType): MappedType
    {
        $type = new MappedType();

        if (property_exists($expandedType, Keyword::TYPE->value)) {
            $type->type = $this->removeSchemaOrgDomain(...(array) $expandedType->{Keyword::TYPE->value});
        }

        if (property_exists($expandedType, 'http://schema.org/name')) {
            $type->name = $expandedType->{'http://schema.org/name'}[0]->{Keyword::VALUE->value};
        } elseif (property_exists($expandedType, 'https://schema.org/name')) {
            $type->name = $expandedType->{'https://schema.org/name'}[0]->{Keyword::VALUE->value};
        }

        foreach ($expandedType as $label => $value) {
            if (
                Keyword::ID->value === $label
                && IriResolver::isBlankNodeIdentifier($value)
            ) {
                $this->saveFlattenedTypeReference($value, $type);
            }

            if (null !== $value) {
                $propertyKey = $this->removeSchemaOrgDomain($label);

                if (\is_string($propertyKey)) {
                    $type->properties[$propertyKey] = $this->mapProperty($value, $propertyKey, $type);
                }
            }
        }

        return $type;
    }

    private function mapProperty(mixed $value, string $key, MappedType $type): MappedProperty
    {
        $property = new MappedProperty($key, $type);

        if (\is_string($value)) {
            $property->value = $value;

            return $property;
        }

        foreach ($value as $valueEntry) {
            if ($this->isTypeReference($valueEntry)) {
                $this->savePropertyWithReference($valueEntry, $property);
            }

            if ($this->isTypeProperty($valueEntry)) {
                $valueEntry = $this->mapType($valueEntry);
                $valueEntry->parent = $property->type;
            }

            if ($this->isValueOrId($valueEntry)) {
                $valueEntry = $this->retrieveValueOrId($valueEntry);
            }

            if (\is_string($valueEntry) && Keyword::TYPE->value === $key) {
                $valueEntry = $this->removeSchemaOrgDomain($valueEntry);
            }

            $property->value[] = $valueEntry;
        }

        if (1 === \count($property->value)) {
            $propertyValue = $property->value[0];

            if ($this->isValueOrId($propertyValue)) {
                $property->value = $this->retrieveValueOrId($propertyValue);
            } else {
                $property->value = $propertyValue;
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

            if ($this->isParsedFlattenedTypeReference($parsedJsonLd)) {
                $identifier = $parsedJsonLd->getProperty(Keyword::ID->value)->value->content;
                $parsedJsonLd = $this->rootParsedJsonLd->getGraphValue($identifier)->content;
            }

            $type->addValueRange($parsedJsonLd->range);
        }

        $properties = $type->properties;

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

        $property->addKeyRange($parsedKey->range);
        $property->addValueRange($parsedValue->range);

        if (IriResolver::isBlankNodeIdentifier($parsedValue->content)) {
            return;
        }

        if ($property->value instanceof MappedType) {
            // When a date is encountered during expansion, it converted to a type. This is not the case on the original JSON-LD, it is only a string.
            if (\is_string($parsedValue->content) && DateModel::LABEL === $property->value->type) {
                $property->value->addKeyRange($parsedKey->range);
                $property->value->addValueRange($parsedValue->range);

                return;
            }

            if ($parsedValue->content instanceof AbstractStructure) {
                $this->addRangesToType($property->value, $parsedValue->content);
            }
        }

        if (\is_array($property->value)) {
            if (!$parsedValue->content instanceof ArrayStructure) {
                throw new \RuntimeException('Property value is an array but parsed value is not an array structure.');
            }

            foreach ($property->value as $key => $value) {
                $content = $parsedValue->content->getValue($key)->content;

                if ($value instanceof MappedType && $content instanceof AbstractStructure) {
                    $this->addRangesToType($value, $content);
                }
            }
        }
    }

    /**
     * Finding a property on an ObjectStructure is not that easy because its properties will follow the JSON-LD format the user provided.
     * So it may be in either of the compacted, expanded, flattened or framed formats. We have to check for every single one.
     */
    private function retrieveParsedValue(MappedProperty $property, ObjectStructure $parsedJsonLd): Property|Value|false
    {
        $shortPropertyKey = $property->key;
        $expandedPropertyKey = $this->appendSchemaOrgDomain($property->key);

        try {
            // Compacted
            return $parsedJsonLd->getProperty($shortPropertyKey);
        } catch (\InvalidArgumentException $exception) {
            try {
                // Expanded
                return $parsedJsonLd->getProperty($expandedPropertyKey);
            } catch (\InvalidArgumentException $exception) {
                if ($reference = $this->findPropertyReference($property)) {
                    return $this->rootParsedJsonLd->getGraphValue($reference);
                }

                return false;
            }
        }
    }

    private function saveFlattenedTypeReference(string $identifier, MappedType $type): void
    {
        $this->flattenedTypeReferences[$identifier] = $type;
    }

    private function savePropertyWithReference(\stdClass $valueEntry, MappedProperty $property): void
    {
        if (\is_string($valueEntry->{Keyword::ID->value})) {
            $this->propertiesWithReferences[$valueEntry->{Keyword::ID->value}] = $property;
        }
    }

    private function findPropertyReference(MappedProperty $property): ?string
    {
        return array_search(
            $property,
            $this->propertiesWithReferences,
            true,
        ) ?: null;
    }

    private function isParsedFlattenedTypeReference(AbstractStructure $type): bool
    {
        if (!$type instanceof ObjectStructure) {
            return false;
        }

        $properties = $type->getProperties();

        return 1 === \count($properties)
            && \array_key_exists('id', $properties)
            && IriResolver::isBlankNodeIdentifier($properties['id']->value->content);
    }

    private function isTypeReference(\stdClass|MappedType|string $valueEntry): bool
    {
        return $valueEntry instanceof \stdClass
            && property_exists($valueEntry, Keyword::ID->value)
            && IriResolver::isBlankNodeIdentifier($valueEntry->{Keyword::ID->value})
            && 1 === \count(get_object_vars($valueEntry));
    }

    private function getFlattenedTypeReference(string $identifier): MappedType
    {
        return $this->flattenedTypeReferences[$identifier];
    }

    private function mapFlattenedTypes(): void
    {
        foreach ($this->propertiesWithReferences as $property) {
            if (\is_string($property->value)) {
                $property->value = $this->getFlattenedTypeReference($property->value);

                continue;
            }

            if (\is_array($property->value)) {
                $actualTypes = [];

                foreach ($property->value as $propertyTypeEntry) {
                    if ($propertyTypeEntry instanceof MappedType) {
                        $actualTypes = $property->value;

                        continue;
                    }

                    $actualTypes[] = $this->getFlattenedTypeReference($propertyTypeEntry->{Keyword::ID->value});
                }

                $property->value = $actualTypes;
            }
        }
    }

    private function isTypeProperty(\stdClass|string $valueEntry): bool
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

    private function isValueOrId(\stdClass|MappedType|string $valueEntry): bool
    {
        if ($valueEntry instanceof MappedType) {
            return false;
        }

        return property_exists($valueEntry, Keyword::VALUE->value) || property_exists($valueEntry, Keyword::ID->value);
    }

    /**
     * Both values will not be present at the same time.
     * Value is used for regular values, while ID is used for URIs.
     */
    private function retrieveValueOrId(\stdClass $basicProperty): string|bool
    {
        if (property_exists($basicProperty, Keyword::VALUE->value)) {
            return $basicProperty->{Keyword::VALUE->value};
        }

        return $basicProperty->{Keyword::ID->value};
    }

    private function appendSchemaOrgDomain(string $property): string
    {
        return \sprintf('%s%s', self::SCHEMA_ORG_DOMAIN, $property);
    }
}
