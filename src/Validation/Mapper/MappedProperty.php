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

readonly class MappedProperty
{
    public function __construct(
        public string $key,
        public mixed $value,
        public bool $hasError,
        public string $message,
    ) {
    }
}
