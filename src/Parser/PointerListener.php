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

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\Nodes\AttributeNode;
use Jolicode\JsonLd\Parser\Nodes\KeywordNode;
use Jolicode\JsonLd\Parser\Nodes\TypeNode;
use JsonStreamingParser\Listener\IdleListener;
use JsonStreamingParser\Listener\PositionAwareInterface;

class PointerListener extends IdleListener implements PositionAwareInterface
{
    public function __construct(
        private int $startLineNumber = 0,
        private ?int $currentColumn = null,
        private ?int $currentLine = null,
        private ?TypeNode $rootType = null,
        private ?TypeNode $currentType = null,
        private string|int|null $currentKey = null,
        private TypeNode|string|null $currentNode = null,
    ) {
    }

    public function getRootType(): TypeNode
    {
        return $this->rootType;
    }

    public function startDocument(): void
    {
        $this->currentLine = 0;
        $this->currentColumn = 0;
        $this->rootType = new TypeNode();
        $this->currentType = $this->rootType;
    }

    public function endDocument(): void
    {
        $this->rootType = end($this->rootType->children);
    }

    public function endObject(): void
    {
        if ($this->currentNode === $this->currentType) {
            $this->currentType = $this->currentType->parent;
        } else {
            $this->currentNode = $this->currentType;
        }
    }

    public function setFilePosition(int $lineNumber, int $charNumber): void
    {
        $this->currentLine = $lineNumber;
        $this->currentColumn = $charNumber;
    }

    public function key(string|int $key): void
    {
        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= \strlen($key);

        $this->currentKey = $key;

        $this->handleNewKey(new Range($start, $end));
    }

    public function value(mixed $value): void
    {
        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= \strlen($value);

        $this->handleNewValue($value, new Range($start, $end));
    }

    private function getCurrentPosition(): Position
    {
        return new Position($this->currentLine + $this->startLineNumber, $this->currentColumn, $this->startLineNumber < 0);
    }

    private function handleNewKey(Range $range): void
    {
        match ($this->currentKey) {
            Keyword::TYPE->value => $this->addChild($range),
            Keyword::VALUE->value => $this->handleKeyValue($range),
            default => $this->addAttribute($range),
        };
    }

    private function handleNewValue(string $value, Range $range): void
    {
        match ($this->currentKey) {
            Keyword::TYPE->value => $this->currentType->updateType($range, $value),
            Keyword::VALUE->value => $this->handleEntryValue($range, $value),
            default => $this->currentType->attributes[$this->currentKey]->valueRange = $range,
        };
    }

    private function addChild(Range $range): void
    {
        $this->currentType->children[$this->currentNode] = $nestedType = new TypeNode(parent: $this->currentType);
        $nestedType->type = new KeywordNode($range);

        $this->currentType = $nestedType;
        $this->currentNode = $nestedType;
    }

    private function addAttribute(Range $range): void
    {
        $this->currentType->attributes[$this->currentKey] = new AttributeNode($range);
        $this->currentNode = $this->currentKey;
    }

    private function handleKeyValue(Range $range): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->value = new KeywordNode($range);
        } else {
            $this->currentType->attributes[$this->currentNode] = new AttributeNode($range);
        }
    }

    private function handleEntryValue(Range $range, mixed $value): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->updateValue($range, $value);
        } else {
            $this->currentType->attributes[$this->currentNode]->valueRange = $range;
        }
    }
}
