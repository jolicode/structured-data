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

class Type
{
    public function __construct(
        public ?string $name = null,
        public ?string $documentationUrl = null,
        public bool $isASubtype = false,
        public ?self $parentType = null,

        /**
         * @var array<string, Type>
         */
        public array $subTypes = [],

        private ?Property $currentProperty = null,

        /**
         * @var array<string, Property>
         */
        private array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        private array $recommendedProperties = [],

        /**
         * @var array<string, Property>
         */
        private array $betaProperties = [],
    ) {
    }

    public function isEmpty(): bool
    {
        return !\count($this->requiredProperties)
            && !\count($this->recommendedProperties)
            && !\count($this->betaProperties)
            && !\count($this->subTypes);
    }

    public function hasProperty(string $property): bool
    {
        return \array_key_exists($property, $this->requiredProperties)
            || \array_key_exists($property, $this->recommendedProperties)
            || \array_key_exists($property, $this->betaProperties);
    }

    public function initProperty(string $name, string $severity, bool $isBeta): void
    {
        $targetProperties = "{$severity}Properties";

        if (!\array_key_exists($name, $this->{$targetProperties})) {
            $this->{$targetProperties}[$name] = new Property($name, isBeta: $isBeta);
        }

        $this->currentProperty = $this->{$targetProperties}[$name];
    }

    public function pushProperty(string $value, bool $isBeta): void
    {
        $this->currentProperty->values[$value] = new Property($value, isBeta: $isBeta);
    }

    public function addPropertyProperty(string $name, array $propertyToUpdate, string $severity, bool $isBeta): void
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

        unset($this->currentProperty);
    }

    private function addNestedPropertyToValue(
        Property $property,
        string $targetValue,
        string $severity,
        string $propertyName,
        bool $isBeta
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

    private function handleNestedProperty(Property $property, string $severity): void
    {
        $propertiesChain = explode('.', $property->name);
        [$propertyName, $propertyProperty] = $propertiesChain;

        $targetProperties = "{$severity}Properties";

        $propertyToUpdate = $this->findPropertyToUpdate($this->{$targetProperties}, $propertyName);

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
