<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\Nodes;

use Jolicode\JsonLd\Parser\Range;

class AttributeNode
{
    public function __construct(
        public ?Range $keyRange = null,
        public ?Range $valueRange = null,
    ) {
    }
}
