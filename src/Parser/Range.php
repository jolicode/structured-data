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

class Range
{
    public Position $start;

    public Position $end;

    public function __construct(Position $start = null, Position $end = null)
    {
        if (null !== $start) {
            $this->start = $start;
        }

        if (null !== $end) {
            $this->end = $end;
        }
    }
}
