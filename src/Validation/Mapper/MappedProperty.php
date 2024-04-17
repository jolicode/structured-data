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

class MappedProperty
{
    public function __construct(
        readonly public string $key,
        public mixed $value = [],
        /**
         * @var array<MappedError>
         */
        public array $errors = [],
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
}
