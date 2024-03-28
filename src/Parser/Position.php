<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser;

class Position
{
    public function __construct(
        public int $line = 0,
        public int $column = 0,
    ) {
    }

    public function __toString()
    {
        return sprintf('%s:%s', $this->line, $this->column);
    }
}
