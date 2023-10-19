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

        /**
         * @var array<Property>
         */
        public array $values = [],

        /**
         * @var array<Property>
         */
        public array $requiredProperties = [],

        /**
         * @var array<Property>
         */
        public array $recommendedProperties = [],

        public bool $isBeta = false,
    ) {
    }

    public function hasRequiredProperties(): bool
    {
        return \count($this->requiredProperties);
    }

    public function hasRecommendedProperties(): bool
    {
        return \count($this->recommendedProperties);
    }

    public function addValue(string $name, bool $isBeta = false): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            foreach ($this->values as $value) {
                $value->addValue($name, $isBeta);
            }

            return;
        }

        $this->values[$name] = new self($name, isBeta: $isBeta);
    }

    public function removeValue(string $name, bool $isBeta = false): void
    {
        if (str_starts_with($this->name, 'atLeastOneOf')) {
            foreach ($this->values as $value) {
                $value->removeValue($name, $isBeta);
            }

            return;
        }

        unset($this->values[$name]);
    }
}
