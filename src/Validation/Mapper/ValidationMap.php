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
         * @var MappedError[]
         */
        private array $errors = [],

        /**
         * @var MappedType[]
         */
        private array $types = [],
    ) {
    }

    public function isValid(): bool
    {
        return 0 === \count($this->errors);
    }

    /**
     * @return MappedError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string[]
     */
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

    /**
     * @return MappedType[]
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    public function addType(MappedType $type): void
    {
        $this->types[] = $type;
    }
}
