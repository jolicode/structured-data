<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\Properties;

use Jolicode\JsonLd\Parser\DataStructures\AbstractStructure;
use Jolicode\JsonLd\Parser\Range;

class Value
{
    public function __construct(
        public readonly Range $range,
        public readonly AbstractStructure|string|bool|null $content,
    ) {
    }
}
