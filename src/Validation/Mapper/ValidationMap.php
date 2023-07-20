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

class ValidationMap
{
    public function __construct(
        /**
         * MappedError[].
         */
        private array $errors = [],

        /**
         * MappedType[].
         */
        private array $types = [],
    ) {
    }

    public function hasErrors(): bool
    {
        return \count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function addError(MappedError $error): void
    {
        $this->errors[] = $error;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function addType(MappedType $type): void
    {
        $this->types[] = $type;
    }
}
