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

    public function initRequiredProperty(string $name, bool $isBeta): void
    {
        if (!\array_key_exists($name, $this->requiredProperties)) {
            $this->requiredProperties[$name] = new Property($name, isBeta: $isBeta);
        }

        $this->currentProperty = $this->requiredProperties[$name];
    }

    public function initRecommendedProperty(string $name, bool $isBeta): void
    {
        if (!\array_key_exists($name, $this->recommendedProperties)) {
            $this->recommendedProperties[$name] = new Property($name, isBeta: $isBeta);
        }

        $this->currentProperty = $this->recommendedProperties[$name];
    }

    public function pushRequiredProperty(string $value, bool $isBeta): void
    {
        $this->currentProperty->values[$value] = new Property($value, isBeta: $isBeta);
    }

    public function pushRecommendedProperty(string $value, bool $isBeta): void
    {
        $this->currentProperty->values[$value] = new Property($value, isBeta: $isBeta);
    }

    public function addPropertyRequiredProperty(string $name, string $propertyToUpdate, bool $isBeta): void
    {
        if (\array_key_exists($propertyToUpdate, $this->requiredProperties)) {
            $this->requiredProperties[$propertyToUpdate]->requiredProperties[$name] = new Property($name, isBeta: $isBeta);
            $this->currentProperty = $this->requiredProperties[$propertyToUpdate]->requiredProperties[$name];

            if (str_contains($name, '.')) {
                $this->handleNestedRequiredProperty($this->currentProperty);
            }
        } elseif (\array_key_exists($propertyToUpdate, $this->recommendedProperties)) {
            $this->recommendedProperties[$propertyToUpdate]->requiredProperties[$name] = new Property($name, isBeta: $isBeta);
            $this->currentProperty = $this->recommendedProperties[$propertyToUpdate]->requiredProperties[$name];

            if (str_contains($name, '.')) {
                $this->handleNestedRequiredProperty($this->currentProperty);
            }
        }
    }

    public function addPropertyRecommendedProperty(string $name, string $propertyToUpdate, bool $isBeta): void
    {
        if (\array_key_exists($propertyToUpdate, $this->requiredProperties)) {
            $this->requiredProperties[$propertyToUpdate]->recommendedProperties[$name] = new Property($name, isBeta: $isBeta);
            $this->currentProperty = $this->requiredProperties[$propertyToUpdate]->recommendedProperties[$name];

            if (str_contains($propertyToUpdate, '.')) {
                $this->handleNestedRecommendedProperty($this->currentProperty);
                unset($this->requiredProperties[$propertyToUpdate]->recommendedProperties[$name]);
            }
        } elseif (\array_key_exists($propertyToUpdate, $this->recommendedProperties)) {
            $this->recommendedProperties[$propertyToUpdate]->recommendedProperties[$name] = new Property($name, isBeta: $isBeta);
            $this->currentProperty = $this->recommendedProperties[$propertyToUpdate]->recommendedProperties[$name];

            if (str_contains($propertyToUpdate, '.')) {
                $this->handleNestedRecommendedProperty($this->currentProperty);
                unset($this->recommendedProperties[$propertyToUpdate]->recommendedProperties[$name]);
            }
        }
    }

    public function cleanUpRequiredProperties(): void
    {
        foreach ($this->requiredProperties as $property) {
            if (!\count($property->values)) {
                unset($this->requiredProperties[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                $this->handleNestedRequiredProperty($property);

                unset($this->requiredProperties[$property->name]);
            }
        }

        unset($this->currentProperty);
    }

    public function cleanUpRecommendedProperties(): void
    {
        foreach ($this->recommendedProperties as $property) {
            if (!\count($property->values)) {
                unset($this->recommendedProperties[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                $this->handleNestedRecommendedProperty($property);

                unset($this->recommendedProperties[$property->name]);
            }
        }

        unset($this->currentProperty);
    }

    private function handleNestedRequiredProperty(Property $property): void
    {
        $propertiesChain = explode('.', $property->name);
        [$propertyName, $propertyProperty] = $propertiesChain;
        // Google may use nested required properties. From what I saw, they never go further than 2 levels.
        // Hence we handle them this way.
        $propertyPropertyRequiredProperty = $propertiesChain[2] ?? null;

        $propertyToUpdate = $this->findPropertyToUpdate($this->requiredProperties, $propertyName);

        if (!$propertyToUpdate) {
            $this->initRecommendedProperty($propertyName, $property->isBeta);
            $propertyToUpdate = $this->currentProperty;
        }

        if (!\array_key_exists($propertyProperty, $propertyToUpdate->requiredProperties)) {
            $propertyToUpdate->requiredProperties[$propertyProperty] = new Property($propertyProperty, $property->values, isBeta: $property->isBeta);
        }

        $this->currentProperty = $propertyToUpdate->requiredProperties[$propertyProperty];

        if ($propertyPropertyRequiredProperty) {
            if ('expectsAcceptanceOf.eligibleRegion.@type' === $property->name) {
                dump($propertyToUpdate->requiredProperties[$propertyProperty]->requiredProperties);
            }

            $propertyToUpdate->requiredProperties[$propertyProperty]->requiredProperties[$propertyPropertyRequiredProperty] = new Property($propertyProperty, $property->values, isBeta: $property->isBeta);
            $this->currentProperty = $propertyToUpdate->requiredProperties[$propertyProperty]->requiredProperties[$propertyPropertyRequiredProperty];
        }
    }

    private function handleNestedRecommendedProperty(Property $property): void
    {
        $propertiesChain = explode('.', $property->name);
        [$propertyName, $propertyProperty] = $propertiesChain;
        // Google may use nested recommended properties. From what I saw, they never go further than 2 levels.
        // Hence we handle them this way.
        $propertyPropertyRecommendedProperty = $propertiesChain[2] ?? null;

        $propertyToUpdate = $this->findPropertyToUpdate($this->recommendedProperties, $propertyName) ?:
            $this->findPropertyToUpdate($this->requiredProperties, $propertyName);

        if ($propertyToUpdate) {
            if (!\array_key_exists($propertyProperty, $propertyToUpdate->recommendedProperties)) {
                $propertyToUpdate->recommendedProperties[$propertyProperty] = new Property($propertyProperty, $property->values, isBeta: $property->isBeta);
            }

            if ($propertyPropertyRecommendedProperty) {
                $propertyToUpdate->recommendedProperties[$propertyProperty]->recommendedProperties[$propertyPropertyRecommendedProperty] = $property->values;
            }
        }
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
