<?php

namespace Jolicode\JsonLd\Parser\Elements;

use Jolicode\JsonLd\Parser\Range;

class ContextNode
{
    public function __construct(
        public ?Range $keyRange = null,
        public ?Range $valueRange = null,
        public ?string $value = null,
        public bool $isValid = true,
    ) {
    }
}
