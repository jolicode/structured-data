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

use Jolicode\JsonLd\Parser\KeyValues\Key;
use Jolicode\JsonLd\Parser\KeyValues\KeyValue;
use Jolicode\JsonLd\Parser\KeyValues\Value;
use Jolicode\JsonLd\Parser\Range;

class ObjectStructure extends AbstractStructure
{
    public function __construct(
        public readonly ?AbstractStructure $belongsTo = null,

        /**
         * @var KeyValue[]
         */
        private array $keyValues = [],
    ) {
    }

    public function addKey(string $name, Range $range): void
    {
        $this->keyValues[$name] = new KeyValue(new Key($name, $range));
    }

    public function addValue(AbstractStructure|string|bool|null $value, Range $range): void
    {
        end($this->keyValues)->value = new Value($value, $range);
    }

    public function getLastValue(): Value
    {
        return end($this->keyValues)->value;
    }
}
