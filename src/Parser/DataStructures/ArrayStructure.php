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

use Jolicode\JsonLd\Parser\KeyValues\Value;
use Jolicode\JsonLd\Parser\Range;

class ArrayStructure extends AbstractStructure
{
    public function __construct(
        public readonly ?AbstractStructure $belongsTo = null,

        /**
         * @var array<Value>
         */
        private array $values = [],
    ) {
    }

    public function addValue(AbstractStructure|string|bool|null $value, Range $range): void
    {
        $this->values[] = new Value($value, $range);
    }

    public function getLastValue(): Value
    {
        return end($this->values);
    }
}
