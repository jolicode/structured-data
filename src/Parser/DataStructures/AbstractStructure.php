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

abstract class AbstractStructure
{
    public ?AbstractStructure $belongsTo = null;
    public ?Range $range = null;

    abstract public function addValue(self|string|bool|null $value, Range $range): void;

    abstract public function getLastValue(): Value;
}
