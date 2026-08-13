<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser\DataStructures;

use JoliCode\StructuredData\JsonLd\Parser\Properties\Value;
use JoliCode\StructuredData\JsonLd\Parser\Range;

class ArrayStructure extends AbstractStructure
{
    public function __construct(
        public ?AbstractStructure $belongsTo = null,
        public ?Range $range = null,
        /**
         * @var Value[]
         */
        private array $values = [],
    ) {
    }

    public function getValue(int $key): Value
    {
        return $this->values[$key];
    }

    /**
     * @return Value[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    public function addValue(AbstractStructure|string|bool|null $value, Range $range): void
    {
        $this->values[] = new Value($range, $value);
    }

    public function getLastValue(): ?Value
    {
        return end($this->values) ?: null;
    }
}
