<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Mapper;

class MappedType
{
    public function __construct(
        public string|array|null $type = null,
        public ?string $name = null,

        /**
         * @var array<MappedProperty>
         */
        public array $properties = [],

        /**
         * @var array<MappedError>
         */
        public array $errors = [],
    ) {
    }
}
