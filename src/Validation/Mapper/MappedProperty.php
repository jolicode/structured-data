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

class MappedProperty
{
    public function __construct(
        readonly public string $key,
        public mixed $value,
        public bool $isValid = true,
        public ?string $errorMessage = null,
    ) {
    }
}
