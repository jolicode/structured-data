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

use Jolicode\JsonLd\Parser\Elements\Type;

class SourceMap
{

    public function __construct(
        public Type $type,

        /**
         * @var array<string, Range>
         */
        public array $keyRanges = [],

        /**
         * @var array<string, Range>
         */
        public array $valueRanges = [],
    ) {
    }

    public function addKeyRange(string $key, Range $range): void
    {
        $this->keyRanges[$key] = $range;
    }

    public function addValueRange(string $key, Range $range): void
    {
        $this->valueRanges[$key] = $range;
    }
}
