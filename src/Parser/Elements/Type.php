<?php

namespace Jolicode\JsonLd\Parser\Elements;

class Type
{
    public function __construct(
        public readonly ?Element $context = null,
        public readonly ?Element $type = null,
        public readonly ?Element $value = null,

        public readonly ?Type $parent = null,

        /**
         * @var array<string, Element>
         */
        public array $attributes = [],
    ) {
    }
}
