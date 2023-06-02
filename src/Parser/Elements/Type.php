<?php

namespace Jolicode\JsonLd\Parser\Elements;

use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;

class Type
{
    public function __construct(
        public ?ContextNode $context = null,
        public ?TypeNode $type = null,
        public ?ValueNode $value = null,

        public readonly ?Type $parent = null,

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

    public function handleNewKey(string $key, Range $range): void
    {
        match ($key) {
            is_numeric($key) => null,
            Keyword::CONTEXT->value => $this->context = new ContextNode($range),
            Keyword::TYPE->value => $this->type = new TypeNode($range),
            Keyword::VALUE->value => $this->value = new ValueNode($range),
            default => $this->attributes[$key] = new AttributeNode($range),
        };
    }

    public function handleNewValue(string $key, string $value, Range $range): void
    {
        match ($key) {
            Keyword::CONTEXT->value => $this->updateContext($range, $value),
            Keyword::TYPE->value => $this->updateType($range, $value),
            Keyword::VALUE->value => $this->updateValue($range, $value),
            default => $this->attributes[$key]->valueRange = $range,
        };
    }

    private function updateContext(Range $range, string $value): void
    {
        $this->context->valueRange = $range;
        $this->context->value = $value;
    }

    private function updateType(Range $range, string $value): void
    {
        $this->type->valueRange = $range;
        $this->type->value = $value;
    }

    private function updateValue(Range $range, string $value): void
    {
        $this->value->valueRange = $range;
        $this->value->value = $value;
    }
}
