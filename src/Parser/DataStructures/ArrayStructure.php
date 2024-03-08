<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\DataStructures;

use Jolicode\JsonLd\Parser\Properties\Value;
use Jolicode\JsonLd\Parser\Range;

class ArrayStructure implements StructureInterface
{
    public function __construct(
        public ?StructureInterface $belongsTo = null,
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

    public function addValue(StructureInterface|string|bool|null $value, Range $range): void
    {
        $this->values[] = new Value($value, $range);
    }

    public function getLastValue(): Value
    {
        return end($this->values);
    }
}
