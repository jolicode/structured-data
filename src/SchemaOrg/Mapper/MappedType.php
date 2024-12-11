<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Mapper;

use Jolicode\JsonLd\Parser\Range;

class MappedType
{
    public function __construct(
        public string|array|null $type = null,
        public ?string $name = null,
        public bool $isValid = true,
        public ?string $errorSeverity = null,
        /**
         * @var array<MappedProperty>
         */
        public array $properties = [],
        /**
         * @var array<MappedError>
         */
        public array $errors = [],
        public ?self $parent = null,
        /**
         * @var array<self>
         */
        public array $children = [],
        /**
         * @var array<Range>
         */
        private array $keyRanges = [],
        /**
         * @var array<Range>
         */
        private array $valueRanges = [],
    ) {
    }

    public function getKeyRanges(): array
    {
        return $this->keyRanges;
    }

    public function addKeyRange(Range $range): void
    {
        if (!\in_array($range, $this->keyRanges, true)) {
            $this->keyRanges[] = $range;
        }
    }

    public function getValueRanges(): array
    {
        return $this->valueRanges;
    }

    public function addValueRange(Range $range): void
    {
        if (!\in_array($range, $this->valueRanges, true)) {
            $this->valueRanges[] = $range;
        }
    }

    public function getProperty(string $name): ?MappedProperty
    {
        return $this->properties[$name] ?? null;
    }

    /**
     * @return string[]
     */
    public function getErrorMessages(): array
    {
        return array_map(
            fn (MappedError $error) => $error->message,
            $this->errors,
        );
    }
}
