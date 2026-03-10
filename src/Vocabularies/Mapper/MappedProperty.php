<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Mapper;

use Jolicode\JsonLd\Parser\Range;

class MappedProperty
{
    public function __construct(
        public readonly string $key,
        public ?MappedType $type = null,
        public ?string $description = null,
        public mixed $value = [],
        public bool $isValid = true,
        public ?string $errorSeverity = null,
        /**
         * @var array<MappedError>
         */
        public array $errors = [],
        /**
         * @var array<Range>
         */
        public array $keyRanges = [],
        /**
         * @var array<Range>
         */
        public array $valueRanges = [],
        /**
         * @var array<string>
         */
        public array $isPartOf = [],
        /**
         * @var array<string>
         */
        public array $source = [],
    ) {
    }

    public function addKeyRange(Range $range): void
    {
        if (!\in_array($range, $this->keyRanges, true)) {
            $this->keyRanges[] = $range;
        }
    }

    public function addValueRange(Range $range): void
    {
        if (!\in_array($range, $this->valueRanges, true)) {
            $this->valueRanges[] = $range;
        }
    }

    public function getKeyPath(): string
    {
        $path = $this->key;

        if ($this->type && $this->type->parentProperty) {
            $path = $this->type->parentProperty->getKeyPath() . '.' . $path;
        }

        return $path;
    }
}
