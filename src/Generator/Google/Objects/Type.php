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

        /**
         * @var array<string, Type>
         */
        public array $subTypes = [],

        /**
         * @var array<string, Property>
         */
        public array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        public array $recommendedProperties = [],
    ) {
    }

    public function getLastRequiredProperty(): Property
    {
        return $this->requiredProperties[array_key_last($this->requiredProperties)];
    }

    public function getLastRecommendedProperty(): Property
    {
        return $this->recommendedProperties[array_key_last($this->recommendedProperties)];
    }

    public function pushRequiredProperty(string $value): void
    {
        $this->getLastRequiredProperty()->value[] = $value;
    }

    public function pushRecommendedProperty(string $value): void
    {
        $this->getLastRecommendedProperty()->value[] = $value;
    }

    public function cleanUpRequiredProperties(): void
    {
        $this->requiredProperties = array_filter($this->requiredProperties, fn (Property $property) => \count($property->value));
    }

    public function cleanUpRecommendedProperties(): void
    {
        $this->recommendedProperties = array_filter($this->recommendedProperties, fn (Property $property) => \count($property->value));
    }
}
