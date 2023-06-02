<?php

namespace Jolicode\JsonLd\Parser\Elements;

use Jolicode\JsonLd\Parser\Range;

class AttributeNode
{
    public function __construct(
        public ?Range $keyRange = null,
        public ?Range $valueRange = null,
    ) {
    }
}
