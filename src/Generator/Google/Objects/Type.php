<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\Google\Objects;

use Jolicode\JsonLd\Generator\Google\Extractor;

class Type
{
    public function __construct(
        /**
         * The name used to identify the type.
         */
        public ?string $name = null,

        /**
         * The type(s) expected. Most of the time it equals to the name, but it may be an array of types.
         *
         * @var array<string> $types
         */
        public array|string $types = [],

        /**
         * Used to retrieve properties from another type. Only used for LearningVideos and LearningClips for now.
         *
         * @var string|array<string>|null $types
         */
        public string|array|null $dependsOn = null,

        /**
         * The link to the type documentation.
         */
        public ?string $documentationUrl = null,

        /**
         * Used on the book page, which has 2 different types of books, and for carousels as well.
         */
        public bool $isASubtype = false,
        public ?self $parentType = null,

        /**
         * @var array<string, string>
         */
        public array $subTypes = [],

        /**
         * Some types are eligible for a carousel display.
         */
        public bool $isCarouselEligible = false,

        /**
         * Carousels have base required/recommended properties but they may use some others as well.
         */
        public ?self $carousel = null,

        private ?Property $currentProperty = null,
        private int $atLeastOneOfCounter = 0,

        /**
         * @var array<string, Property>
         */
        private array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        private array $recommendedProperties = [],
    ) {
    }

    public function hasProperty(string $property): bool
    {
        return \array_key_exists($property, $this->requiredProperties)
            || \array_key_exists($property, $this->recommendedProperties);
    }

    public function getProperty(string $name): ?Property
    {
        return $this->requiredProperties[$name]
        ?? $this->recommendedProperties[$name]
        ?? null;
    }

    /**
     * A method used to set the right name to identify subtypes (it basically adds the subtype name to the main type name).
     */
    public function setCurrentValueSubtype(string $newName): void
    {
        $originalValue = $this->currentProperty->values[array_key_last($this->currentProperty->values)];
        $originalName = $originalValue->name;

        unset($this->currentProperty->values[$originalName]);

        $newName = sprintf('%s %s', $originalName, $newName);
        $originalValue->name = $newName;

        $this->currentProperty->values[$newName] = $originalValue;
    }

    public function initProperty(string $name, string $severity, bool $isBeta = false, array $atLeastOneOf = []): void
    {
        $targetProperties = "{$severity}Properties";

        if ($atLeastOneOf) {
            $name = 'atLeastOneOf_' . $this->atLeastOneOfCounter++;
        }

        if (Extractor::SEVERITY_RECOMMENDED === $severity && \array_key_exists($name, $this->requiredProperties)) {
            $this->recommendedProperties[$name] = $this->requiredProperties[$name];
            $this->currentProperty = $this->recommendedProperties[$name];

            unset($this->requiredProperties[$name]);

            return;
        }

        if (!\array_key_exists($name, $this->{$targetProperties})) {
            $this->{$targetProperties}[$name] = new Property($name, values: $atLeastOneOf, isBeta: $isBeta);
        }

        $this->currentProperty = $this->{$targetProperties}[$name];
    }

    public function pushProperty(string $value, bool $isBeta = false): void
    {
        $this->currentProperty->addValue($value, $isBeta);
    }

    public function addPropertyProperty(string $name, array $propertyToUpdate, string $severity, bool $isBeta = false): void
    {
        [$property, $values] = $propertyToUpdate;

        foreach ($values as $targetValue) {
            if (\array_key_exists($property, $this->requiredProperties)) {
                $this->addNestedPropertyToValue(
                    $this->requiredProperties[$property],
                    $targetValue,
                    $severity,
                    $name,
                    $isBeta
                );
            } elseif (\array_key_exists($property, $this->recommendedProperties)) {
                $this->addNestedPropertyToValue(
                    $this->recommendedProperties[$property],
                    $targetValue,
                    $severity,
                    $name,
                    $isBeta
                );
            }
        }
    }

    /**
     * Removes empty properties and builds the nested properties.
     */
    public function cleanUpProperties(string $severity): void
    {
        $targetProperties = "{$severity}Properties";

        foreach ($this->{$targetProperties} as $property) {
            if (!\count($property->values)) {
                unset($this->{$targetProperties}[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                $this->handleNestedProperty($property, $severity);

                unset($this->{$targetProperties}[$property->name]);
            }
        }

        ksort($this->{$targetProperties});

        $this->currentProperty = null;
    }

    /**
     * A pretty dire-looking method...
     *
     * However, all it does is :
     *  - get the properties chain if the property is nested
     *  - add the new property to the current property if it is not already there
     *  - add the potential nested properties to the current property properties if needed
     *  - set the current property to the new property
     *
     * @param Property $property     The initial property to add the new property to
     * @param string   $targetValue  The initial property value we want to update
     * @param string   $severity     The severity of the property (recommended/required)
     * @param string   $propertyName The full name of the new property (which may contain dots, indicating a nested property)
     */
    private function addNestedPropertyToValue(
        Property $property,
        string $targetValue,
        string $severity,
        string $propertyName,
        bool $isBeta = false
    ): void {
        if (str_contains($propertyName, '.')) {
            $propertiesChain = explode('.', $propertyName);
            [$propertyName, $propertyProperty] = $propertiesChain;
            $propertyPropertyNestedProperty = $propertiesChain[2] ?? null;
        }

        $targetProperties = "{$severity}Properties";

        if (!\array_key_exists($propertyName, $property->values[$targetValue]->{$targetProperties})) {
            $targetProperty = new Property($propertyName, isBeta: $isBeta);

            $property
                ->values[$targetValue]
                ->{$targetProperties}[$propertyName] = $targetProperty;
        } else {
            $targetProperty = $property
                ->values[$targetValue]
                ->{$targetProperties}[$propertyName];
        }

        if (isset($propertyProperty)) {
            if (!\array_key_exists($propertyProperty, $targetProperty->{$targetProperties})) {
                $newProperty = new Property($propertyProperty, isBeta: $isBeta);
                $targetProperty->{$targetProperties}[$propertyProperty] = $newProperty;
            } else {
                $newProperty = $targetProperty->{$targetProperties}[$propertyProperty];
            }

            $targetProperty = $newProperty;
        }

        if (isset($propertyPropertyNestedProperty)) {
            $secondNewProperty = new Property($propertyPropertyNestedProperty, isBeta: $isBeta);
            $targetProperty->{$targetProperties}[$propertyPropertyNestedProperty] = $secondNewProperty;

            $targetProperty = $secondNewProperty;
        }

        $this->currentProperty = $targetProperty;
    }

    /**
     * Nested properties are (most of the time...) indicated thanks to a dot notation, like `firstProperty.secondProperty`.
     * This method will split the string to get the properties chain, and then update the current property accordingly.
     */
    private function handleNestedProperty(Property $property, string $severity): void
    {
        $propertiesChain = explode('.', $property->name);
        [$propertyName, $propertyProperty] = $propertiesChain;

        $targetProperties = "{$severity}Properties";
        $propertyToUpdate = $this->findPropertyToUpdate($this->recommendedProperties, $propertyName) ?: $this->findPropertyToUpdate($this->requiredProperties, $propertyName);

        if (!$propertyToUpdate) {
            $this->initProperty($propertyName, $severity, $property->isBeta);
            $propertyToUpdate = $this->currentProperty;
        }

        if (!\array_key_exists($propertyProperty, $propertyToUpdate->{$targetProperties})) {
            $propertyToUpdate->{$targetProperties}[$propertyProperty] = new Property($propertyProperty, $property->values, isBeta: $property->isBeta);
        }

        $this->currentProperty = $propertyToUpdate->{$targetProperties}[$propertyProperty];
    }

    /**
     * @param array<string, Property> $potentialProperties
     */
    private function findPropertyToUpdate(array $potentialProperties, string $propertyToFind, string $whereToSearch = 'values'): Property|false
    {
        foreach ($potentialProperties as $property) {
            if (\is_string($property)) {
                continue;
            }

            if ($propertyToFind === $property->name) {
                return $property;
            }

            if ($propertyToUpdate = $this->findPropertyToUpdate($property->{$whereToSearch}, $propertyToFind, $whereToSearch)) {
                return $propertyToUpdate;
            }
        }

        return false;
    }
}
