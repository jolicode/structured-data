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

interface StructureInterface
{
    public function addValue(self|string|bool|null $value, Range $range): void;

    public function getLastValue(): Value;
}
