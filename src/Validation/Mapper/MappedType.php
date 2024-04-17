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

use Jolicode\JsonLd\Parser\Range;

class MappedType
{
    public function __construct(
        public string|array|null $type = null,
        public ?string $name = null,
        public bool $isValid = true,
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
        private array $ranges = [],
    ) {
    }

    public function getRanges(): array
    {
        return $this->ranges;
    }

    public function addRange(Range $range): void
    {
        if (!\in_array($range, $this->ranges, true)) {
            $this->ranges[] = $range;
        }
    }

    public function getProperty(string $name): ?MappedProperty
    {
        return $this->properties[$name] ?? null;
    }
}
