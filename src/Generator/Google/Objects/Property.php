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
    public function getProperty(string $name, string $typeToSearchOn = null): ?self
    {
        if (!\count($this->types)) {
            return null;
        }

        if ($typeToSearchOn) {
            return $this->types[$typeToSearchOn]->getProperty($name);
        }

        return $this->types[array_key_first($this->types)]->getProperty($name);
    }

    /**
     * @param array<string, PropertyType> $types
     */
    public function addProperties(
        string $propertyName, string $targetProperties, array $types = [], array $atLeastOneOf = []
    ): void {
        /**
         * @var PropertyType $type
         */
        foreach ($this->types as $type) {
            $type->addProperty($propertyName, $targetProperties, $types, $atLeastOneOf);
        }
    }

    public function getType(string $name): ?PropertyType
    {
        return $this->types[$name] ?? null;
    }

    public function addType(string $name): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            $this->atLeastOneOf[$name] = new PropertyType($name);
        }

        $this->types[$name] = new PropertyType($name);
    }

    public function removeType(string $name): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            unset($this->atLeastOneOf[$name]);
        }

        unset($this->types[$name]);
    }
}
