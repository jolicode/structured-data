<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Mapper;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
use Jolicode\JsonLd\Parser\DataStructures\StructureInterface;
use Jolicode\JsonLd\Parser\Position;
use Jolicode\JsonLd\Parser\Properties\Property;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Validation\Error\TypeValidationError;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Validators\Google\GoogleValidator;

class ValidationMapper
{
    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';

    public function __construct(
        /**
         * @var array<string,MappedType>
         */
        public array $flattenedTypeReferences = [],
        private ValidationMap $map = new ValidationMap(),
        /**
         * @var array<MappedError>
         */
        private array $mappedErrors = [],
        /**
         * @var array<string,MappedProperty>
         */
        private array $propertiesWithReferences = [],
    ) {
    }

    public function reset(): void
    {
        $this->map = new ValidationMap();
        $this->mappedErrors = [];
        $this->flattenedTypeReferences = [];
        $this->propertiesWithReferences = [];
    }

    /**
     * @return array<MappedError>
     */
    public function getMappedErrors(): array
    {
        return $this->mappedErrors;
    }

    /**
     * This method takes an expanded JsonLd input and will transform it into an easier to manipulate, more user friendly object.
     */
    public function map(array $expandedJsonLd): ValidationMap
    {
        foreach ($expandedJsonLd as $type) {
            $type = $this->mapType($type);

            // This prevents adding the flattened types to the final result
            if (\count($this->flattenedTypeReferences) > 1) {
                continue;
            }

            $this->map->addType($type);
        }

        $this->mapFlattenedTypes();

        unset($this->propertiesWithReferences);

        return $this->map;
    }

    public function getMap(): ValidationMap
    {
        return $this->map;
    }

    /**
     * @param array<ValidationError> $validationErrors
     */
    public function mapErrorsRanges(array $validationErrors, StructureInterface $parsedJsonLd): void
    {
        foreach ($validationErrors as $error) {
            $typeWithViolation = $this->getTypeWithError($error, $parsedJsonLd);

            if ($error instanceof TypeValidationError) {
                if (Keyword::TYPE->value !== $error->key) {
                    $this->createMappedErrorOnObjectBrackets($error, $typeWithViolation);

                    continue;
                }
            }

            $propertyWithError = $error->hasAGraph ?
                $typeWithViolation->getGraphProperty($error->key, $error->graphKey) :
                $typeWithViolation->getProperty($error->key);

            $this->addMappedError($error, $typeWithViolation, $propertyWithError);
        }
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
            if (Keyword::TYPE->value === $label) {
                continue;
            }

            if (
                Keyword::ID->value === $label
                && IriResolver::isBlankNodeIdentifier($value)
            ) {
                $this->saveFlattenedTypeReference($value, $type);

                continue;
            }

            if (null !== $value) {
                $propertyKey = $this->removeSchemaOrgDomain($label);

                $type->properties[$propertyKey] = $this->mapProperty($value, $propertyKey);
            }
        }

        return $type;
    }

    private function mapProperty(mixed $value, string $key): MappedProperty
    {
        $property = new MappedProperty($key);

        if (\is_string($value)) {
            $property->value = $value;

            return $property;
        }

        foreach ($value as $valueEntry) {
            if ($this->isTypeProperty($valueEntry)) {
                $valueEntry = $this->mapType($valueEntry);
            }

            $property->value[] = $valueEntry;

            if ($this->isFlattenedTypeReference($valueEntry)) {
                $this->savePropertyWithReference($valueEntry, $property);
            }
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

    private function saveFlattenedTypeReference(string $identifier, MappedType $type): void
    {
        $this->flattenedTypeReferences[$identifier] = $type;
    }

    private function savePropertyWithReference(\stdClass $valueEntry, MappedProperty $property): void
    {
        $this->propertiesWithReferences[$valueEntry->{Keyword::ID->value}] = $property;
    }

    private function isFlattenedTypeReference(\stdClass|MappedType $valueEntry): bool
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
                foreach ($property->value as $propertyTypeEntry) {
                    if ($propertyTypeEntry instanceof MappedType) {
                        continue;
                    }

                    $property->value[] = $this->getFlattenedTypeReference($propertyTypeEntry->{Keyword::ID->value});
                }
            }
        }
    }

    private function isTypeProperty(\stdClass $valueEntry): bool
    {
        return !property_exists($valueEntry, Keyword::VALUE->value)
            && !property_exists($valueEntry, Keyword::ID->value)
        ;
    }

    private function isValueOrId(\stdClass|MappedType $valueEntry): bool
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
    private function retrieveValueOrId(\stdClass $basicProperty): string
    {
        if (property_exists($basicProperty, Keyword::VALUE->value)) {
            return $basicProperty->{Keyword::VALUE->value};
        }

        return $basicProperty->{Keyword::ID->value};
    }

    private function addMappedError(ValidationError $error, ObjectStructure $type, Property $property): void
    {
        $typeProperties = $type->getProperties();

        if (\array_key_exists(Keyword::TYPE->value, $typeProperties)) {
            $type = $typeProperties[Keyword::TYPE->value]->value->content;
        } elseif (\array_key_exists('type', $typeProperties)) {
            $type = $typeProperties['type']->value->content;
        } else {
            $type = null;
        }

        $this->map->addError(new MappedError(
            $error->message,
            $type,
            $property->key->name,
            $property->key->range,
            $error->severity,
            $error->validatorName,
        ));
    }

    private function getTypeWithError(ValidationError $error, StructureInterface $parsedJsonLd): ObjectStructure
    {
        /**
         * @var ObjectStructure $rootType
         */
        $rootType = $parsedJsonLd;

        if (0 === \count($error->propertiesChain)) {
            return $rootType;
        }

        // Google validates that a property is MISSING. Obviously it will be impossible to find it on the object properties...
        // So we just return the root type.
        if (GoogleValidator::VALIDATOR_NAME === $error->validatorName) {
            return $rootType;
        }

        $currentType = $rootType;

        if ($error->graphKey) {
            /**
             * @var ArrayStructure $graph
             */
            $graph = $currentType->getProperty(Keyword::GRAPH->value)->value->content;
            $graphEntries = $graph->getValues();

            /**
             * @var ObjectStructure $currentType
             */
            $currentType = $graphEntries[$error->graphKey]->content;
        }

        foreach ($error->propertiesChain as $property) {
            $currentType = $this->retrieveTypeFromProperty($property, $currentType);
        }

        return $currentType;
    }

    /**
     * If property is an array, this means it is a property holding multiple types as a value.
     * The array will be filled with the property name, only its length matter: it is used to know which of its types is the one with an error.
     *
     * @param string|array $property The invalid property
     */
    private function retrieveTypeFromProperty(string|array $property, ObjectStructure $currentType): ObjectStructure|string
    {
        $properties = $currentType->getProperties();

        if (\is_array($property)) {
            $propertyName = $property[0];
        } else {
            $propertyName = $property;
        }

        if (!\array_key_exists($propertyName, $properties)) {
            // When the user provide an expanded input, all properties are prefixed with the schema.org domain.
            // But when we validate it, we strip the schema.org domain, which are automatically added by the expander.
            // So, when mappind back the error to the user input, we will need the schema.org domain to find the property.
            $prefixedPropertyName = sprintf('%s%s', self::SCHEMA_ORG_DOMAIN, $propertyName);

            $propertyWithError = $properties[$prefixedPropertyName];
        } else {
            $propertyWithError = $properties[$propertyName];
        }

        $typeWithError = $propertyWithError->value->content;

        if ($typeWithError instanceof ArrayStructure) {
            if (\is_array($property)) {
                $typeWithError = $typeWithError->getValues()[\count($property) - 1]->content;
            } else {
                $typeWithError = $typeWithError->getValues()[0]->content;
            }
        }

        return $typeWithError;
    }

    /**
     * When the "@type" entry is missing, we cannot map it back to the user input since it does not exist.
     * When this is the case, we map the error on the object brackets.
     */
    private function createMappedErrorOnObjectBrackets(ValidationError $error, ObjectStructure $typeWithViolation): void
    {
        $properties = $typeWithViolation->getProperties();

        $firstProperty = reset($properties);
        $objectStart = $firstProperty->key->range->start;

        $lastProperty = end($properties);
        $objectEnd = $lastProperty->value->range->end;

        $startLine = $objectStart->line - 1;
        $startCol = $objectStart->column - 5;

        $endLine = $objectEnd->line + 1;
        $endCol = $startCol;

        $this->map->addError(new MappedError(
            $error->message,
            null,
            Keyword::TYPE->value,
            new Range(
                new Position($startLine, $startCol),
                new Position($endLine, $endCol),
            ),
            $error->severity,
        ));
    }
}
