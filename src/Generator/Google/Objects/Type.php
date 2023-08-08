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

        /**
         * @var array<string, Type>
         */
        public array $subTypes = [],

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

    public function isEmpty(): bool
    {
        return !\count($this->requiredProperties) && !\count($this->recommendedProperties);
    }

    public function getLastRequiredProperty(): Property
    {
        return $this->requiredProperties[array_key_last($this->requiredProperties)];
    }

    public function getLastRecommendedProperty(): Property
    {
        return $this->recommendedProperties[array_key_last($this->recommendedProperties)];
    }

    public function initRequiredProperty(string $name): void
    {
        if (!\array_key_exists($name, $this->requiredProperties)) {
            $this->requiredProperties[$name] = new Property($name);
        }
    }

    public function initRecommendedProperty(string $name): void
    {
        if (!\array_key_exists($name, $this->recommendedProperties)) {
            $this->recommendedProperties[$name] = new Property($name);
        }
    }

    public function pushRequiredProperty(string $value): void
    {
        $this->getLastRequiredProperty()->values[] = $value;
    }

    public function pushRecommendedProperty(string $value): void
    {
        $this->getLastRecommendedProperty()->values[] = $value;
    }

    public function cleanUpRequiredProperties(): void
    {
        foreach ($this->requiredProperties as $property) {
            if (!\count($property->values)) {
                unset($this->requiredProperties[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                [$propertyName, $propertyProperty] = explode('.', $property->name);

                if (!\array_key_exists($propertyName, $this->requiredProperties)) {
                    foreach ($this->requiredProperties as $property) {
                        if ($propertyName === $property->values[0]) {
                            $propertyToUpdate = $property;
                        }
                    }
                } else {
                    $propertyToUpdate = $this->requiredProperties[$propertyName];
                }

                $propertyToUpdate->requiredValues[] = $propertyProperty;

                unset($this->requiredProperties[$property->name]);
            }
        }
    }

    public function cleanUpRecommendedProperties(): void
    {
        foreach ($this->recommendedProperties as $property) {
            if (!\count($property->values)) {
                unset($this->recommendedProperties[$property->name]);
            }

            if (str_contains($property->name, '.')) {
                [$propertyName, $propertyProperty] = explode('.', $property->name);

                if (!\array_key_exists($propertyName, $this->recommendedProperties)) {
                    foreach ($this->recommendedProperties as $property) {
                        if ($propertyName === $property->values[0]) {
                            $propertyToUpdate = $property;
                        }
                    }
                } else {
                    $propertyToUpdate = $this->recommendedProperties[$propertyName];
                }

                $propertyToUpdate->recommendedProperties[] = $propertyProperty;

                unset($this->recommendedProperties[$property->name]);
            }
        }
    }
}
