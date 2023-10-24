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

/**
 * @class PropertyType PropertyTypes are types found as values of properties.
 */
class PropertyType extends AbstractType
{
    public function __construct(
        /**
         * The name(s) used to identify the type.
         */
        public ?string $name = null,

        /**
         * @var array<string, Property>
         */
        public array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        public array $recommendedProperties = [],
    ) {
        parent::__construct($name, $requiredProperties, $recommendedProperties);
    }

    public function addProperty(
        string $name, string $targetProperties, array $types = [], array $atLeastOneOf = [], bool $isBeta = false
    ): void {
        $this->{$targetProperties}[$name] = new Property($name, types: $types, atLeastOneOf: $atLeastOneOf, isBeta: $isBeta);
    }
}
