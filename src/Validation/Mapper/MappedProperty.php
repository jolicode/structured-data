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

use Jolicode\JsonLd\Validation\Error\ValidationError;

class MappedProperty
{
    public function __construct(
        readonly public string $key,
        public mixed $value = [],

        /**
         * @var array<ValidationError>
         */
        public array $errors = [],
    ) {
    }
}
