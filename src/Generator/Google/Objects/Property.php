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
         * @var array<string>
         */
        public array $requiredValues = [],

        /**
         * @var array<string>
         */
        public array $recommendedValues = [],
    ) {
    }

    public function hasRequiredValues(): bool
    {
        return \count($this->requiredValues);
    }

    public function hasRecommendedValues(): bool
    {
        return \count($this->recommendedValues);
    }
}
