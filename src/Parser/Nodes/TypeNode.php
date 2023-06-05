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

class TypeNode
{
    public function __construct(
        public ?KeywordNode $context = null,
        public ?KeywordNode $type = null,
        public ?KeywordNode $value = null,

        public ?self $parent = null,

        /**
         * @var array<string, Type>
         */
        public array $children = [],

        /**
         * @var array<string, AttributeNode>
         */
        public array $attributes = [],
    ) {
    }

    public function updateContext(Range $range, string $value): void
    {
        $this->context->valueRange = $range;
        $this->context->value = $value;
    }

    public function updateType(Range $range, string $value): void
    {
        $this->type->valueRange = $range;
        $this->type->value = $value;
    }

    public function updateValue(Range $range, string $value): void
    {
        $this->value->valueRange = $range;
        $this->value->value = $value;
    }
}
