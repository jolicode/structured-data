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

class Property
{
    public function __construct(
        public string $name,

        public bool $isBeta = false,

        /**
         * @var array<PropertyType>
         */
        public array $types = [],

        /**
         * @var array<Property>
         */
        private array $atLeastOneOf = [],
    ) {
    }

    /**
     * This method returns a property nested on the current property type.
     * A property may have multiple types, but they all share the same properties, so it is fine returning
     * a property of the first type.
     */
    public function getProperty(string $name): ?self
    {
        if (!\count($this->types)) {
            return null;
        }

        return $this->types[array_key_first($this->types)]?->getProperty($name);
    }

    public function addProperties(string $propertyName, string $targetProperties, bool $isBeta = false): void
    {
        foreach ($this->types as $type) {
            $type->addProperty($propertyName, $targetProperties, isBeta: $isBeta);
        }
    }

    public function getType(string $name): ?PropertyType
    {
        return $this->types[$name] ?? null;
    }

    public function addType(string $name, bool $isBeta = false): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            foreach ($this->types as $type) {
                $type->addType($name, $isBeta);
            }

            return;
        }

        $this->types[$name] = new PropertyType($name);
    }

    public function removeType(string $name, bool $isBeta = false): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            foreach ($this->types as $type) {
                $type->removeType($name, $isBeta);
            }

            return;
        }

        unset($this->types[$name]);
    }
}
