<?php

namespace Jolicode\JsonLd\Parser\Elements;

use Jolicode\JsonLd\Parser\Range;

class Element
{
    public function __construct(
        public Range $keyRange,
        public Range $valueRange,
        public bool $isValid = true,
    ) {
    }
}
