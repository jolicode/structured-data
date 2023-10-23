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
         * @var array<string, Type>
         */
        public array $subTypes = [],

        /**
         * Some types are eligible for a carousel display.
         */
        public bool $isCarouselEligible = false,

        /**
         * Carousels have base required/recommended properties but they may use some others as well.
         */
        public ?Property $carousel = null,

        /**
         * @var array<string, Property> $currentProperties
         */
        private array $currentProperties = [],

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
        foreach ($this->currentProperties as $currentProperty) {
            $originalValue = $currentProperty->values[array_key_last($currentProperty->values)];
            $originalName = $originalValue->name;

            unset($currentProperty->values[$originalName]);

            $newName = sprintf('%s %s', $originalName, $newName);
            $originalValue->name = $newName;

            $currentProperty->values[$newName] = $originalValue;
        }
    }

    public function initProperty(string $name, string $severity, bool $isBeta = false, array $atLeastOneOf = []): void
    {
        $targetProperties = "{$severity}Properties";

        if ($atLeastOneOf) {
            $name = 'atLeastOneOf_' . $this->atLeastOneOfCounter++;
        }

        if (Extractor::SEVERITY_RECOMMENDED === $severity && \array_key_exists($name, $this->requiredProperties)) {
            $this->recommendedProperties[$name] = $this->requiredProperties[$name];
            $this->currentProperties = [$this->recommendedProperties[$name]];

            unset($this->requiredProperties[$name]);

            return;
        }

        if (!\array_key_exists($name, $this->{$targetProperties})) {
            $this->{$targetProperties}[$name] = new Property($name, values: $atLeastOneOf, isBeta: $isBeta);
        }

        $this->currentProperties = [$this->{$targetProperties}[$name]];
    }

    public function pushProperty(string $value, bool $isBeta = false): void
    {
        foreach ($this->currentProperties as $currentProperty) {
            $currentProperty->addValue($value, $isBeta);
        }
    }

    /**
     * Sometimes (for now, only the book page however) a title and its table are meant to update a previous type.
     * When this is the case, we need to find which value to update, and initalize new properties for it.
     * And these properties may even be nested properties, which complicates things.
     * This method is here to handle these (rare) cases.
     */
    public function addPropertyProperty(string $name, array $propertyToUpdate, string $severity, bool $isBeta = false): void
    {
        /**
         * @var string        $property
         * @var array<string> $values
         */
        [$property, $values] = $propertyToUpdate;

        if ($this->hasProperty($property)) {
            $this->addNestedPropertyToValue(
                $this->getProperty($property),
                $values,
                $severity,
                $name,
                $isBeta
            );
        }
    }

    /**
     * Removes empty properties and builds the nested properties.
     */
    public function cleanUpProperties(): void
    {
        $this->cleanUpTargetProperties(Extractor::SEVERITY_REQUIRED);
        $this->cleanUpTargetProperties(Extractor::SEVERITY_RECOMMENDED);

        if (\count($this->subTypes)) {
            foreach ($this->subTypes as $subType) {
                $subType->cleanUpProperties();
            }
        }

        $this->currentProperties = [];
    }

    /**
     * @param Property      $property       The initial property to add the new property to
     * @param array<string> $valuesToUpdate The initial property values we want to update
     * @param string        $propertyName   The full name of the new property (which may contain dots, indicating a nested property)
     * @param string        $severity       The severity of the property (recommended/required)
     */
    private function addNestedPropertyToValue(
        Property $property,
        array $valuesToUpdate,
        string $severity,
        string $propertyName,
        bool $isBeta,
    ): void {
        $propertiesChain = explode('.', $property->name);
        $targetProperties = "{$severity}Properties";

        $this->addPropertiesToValues(
            $propertyName,
            $propertiesChain,
            $property,
            $valuesToUpdate,
            $targetProperties,
            $isBeta,
        );

        $this->currentProperties = [$property];
    }

    private function addPropertiesToValues(
        string $propertyToCreate,
        array $propertiesChain,
        Property $propertyToUpdate,
        array $propertyValuesToUpdate,
        string $targetProperties,
        bool $isBeta,
    ): void {
        $propertyName = array_shift($propertiesChain);

        if (null === $propertyName) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : Reached end of properties chain without finding a property name.');
        }

        // If the property is not found, it means we reached the property we want to add the value to.
        if (!$foundProperty = $propertyToUpdate->getProperty($propertyName)) {
            foreach ($propertyValuesToUpdate as $value) {
                $value = $propertyToUpdate->getValue($value);
                $value->addProperty($propertyToCreate, $targetProperties, isBeta: $isBeta);

                $this->currentProperties[] = $value->getProperty($propertyToCreate);
            }

            return;
        }

        // Else, recursively call this method to find the property.
        $this->addPropertiesToValues($propertyToCreate, $propertiesChain, $foundProperty, $propertyValuesToUpdate, $targetProperties, $isBeta);
    }

    private function cleanUpTargetProperties(string $severity): void
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
    }

    /**
     * Nested properties are (most of the time...) indicated thanks to a dot notation, like `firstProperty.secondProperty`.
     * This method will split the string to get the properties chain and initialize a property on the last element of the chain.
     */
    private function handleNestedProperty(Property $property, string $severity): void
    {
        $propertiesChain = explode('.', $property->name);

        if (1 === \count($propertiesChain)) {
            $firstPropertyName = $property->name;
        } else {
            $firstPropertyName = array_shift($propertiesChain);
        }

        if (null === $firstPropertyName) {
            throw new \RuntimeException(sprintf('Trying to parse a nested property but the following provided string is invalid : "%s"', $property->name));
        }

        $actualFirstProperty = $this->getProperty($firstPropertyName);

        if (null === $actualFirstProperty) {
            $this->initProperty($firstPropertyName, $severity, isBeta: $property->isBeta);

            foreach ($property->values as $value) {
                $this->pushProperty($value->name, isBeta: $value->isBeta);
            }

            $actualFirstProperty = $this->getProperty($firstPropertyName);
        }

        if (null === $actualFirstProperty) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : The first property of the chain could not be found.');
        }

        $this->initializeNestedProperty($propertiesChain, $actualFirstProperty, $property->values, $severity);
    }

    /**
     * @param array<string> $propertiesChain
     * @param array<mixed>  $valuesToAdd
     */
    private function initializeNestedProperty(
        array $propertiesChain, Property $property, array $valuesToAdd, string $severity
    ): void {
        $propertyName = array_shift($propertiesChain);

        if (null === $propertyName) {
            throw new \RuntimeException('Error while attempting to initialize a nested property : Reached end of properties chain without finding a property name.');
        }

        $targetProperties = "{$severity}Properties";

        if ($foundProperty = $property->getProperty($propertyName)) {
            $this->initializeNestedProperty($propertiesChain, $foundProperty, $valuesToAdd, $severity);

            return;
        }

        $property->addProperty($propertyName, $targetProperties, isBeta: $property->isBeta);

        $this->currentProperties = [$property->getProperty($propertyName)];
    }
}
