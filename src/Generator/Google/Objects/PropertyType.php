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

class PropertyType extends AbstractType
{
    public function __construct(
        /**
         * The name(s) used to identify the type.
         */
        public string|array $names = [],

        /**
         * @var array<string, Property>
         */
        protected array $requiredProperties = [],

        /**
         * @var array<string, Property>
         */
        protected array $recommendedProperties = [],
    ) {
        parent::__construct($names, $requiredProperties, $recommendedProperties);
    }

    public function addProperty(string $name, string $targetProperties, array $atLeastOneOf = [], bool $isBeta = false): void
    {
        $this->{$targetProperties}[$name] = new Property($name, atLeastOneOf: $atLeastOneOf, isBeta: $isBeta);
    }
}
