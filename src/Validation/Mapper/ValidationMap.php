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
        private array $tree = [],
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorMessages(): array
    {
        return array_map(
            fn (MappedError $error) => $error->message,
            $this->errors
        );
    }

    public function addError(MappedError $error): void
    {
        $this->errors[] = $error;
    }

    public function getTree(): array
    {
        return $this->tree;
    }

    public function addType(MappedType $type): void
    {
        $this->tree[] = $type;
    }
}
