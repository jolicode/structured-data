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
        return new Position($this->currentLine, $this->currentColumn);
    }

    private function handleNewKey(Range $range): void
    {
        match ($this->currentKey) {
            Keyword::TYPE->value => $this->addChild($range),
            Keyword::VALUE->value => $this->handleValueKey($range),
            Keyword::ID->value => $this->handleIdKey($range),
            default => $this->addAttribute($range),
        };
    }

    private function handleNewValue(string $value, Range $range): void
    {
        match ($this->currentKey) {
            Keyword::TYPE->value => $this->currentType->updateType($range, $value),
            Keyword::VALUE->value => $this->handleValueEntry($range, $value),
            Keyword::ID->value => $this->handleIdEntry($range, $value),
            default => $this->currentType->attributes[$this->currentKey]->valueRange = $range,
        };
    }

    private function addChild(Range $range): void
    {
        // TODO: handle ID keys: they will come BEFORE the type key, so the child will not be created. We need to get the ID, set it on the child, and unset it.

        // If current node is an instance of TypeNode, this means the property holds a list of types.
        if ($this->currentNode instanceof TypeNode) {
            // Current node might be a TypeNode with no children yet.
            if (!\count($this->currentType->children)) {
                $this->currentType->children[] = $nestedType = new TypeNode(parent: $this->currentType);
            } else {
                $this->currentNode = array_key_last($this->currentType->children);

                // Check if the value is already an array.
                if (\is_array($this->currentType->children[$this->currentNode])) {
                    $this->currentType->children[$this->currentNode] = [
                        ...$this->currentType->children[$this->currentNode],
                        $nestedType = new TypeNode(parent: $this->currentType),
                    ];
                } else {
                    // If not, convert it to an array.
                    $this->currentType->children[$this->currentNode] = [
                        $this->currentType->children[$this->currentNode],
                        $nestedType = new TypeNode(parent: $this->currentType),
                    ];
                }
            }
        } else {
            $this->currentType->children[$this->currentNode] = $nestedType = new TypeNode(parent: $this->currentType);
        }

        $nestedType->type = new KeywordNode($range);
        $this->currentType = $nestedType;
        $this->currentNode = $nestedType;
    }

    private function addAttribute(Range $range): void
    {
        $this->currentType->attributes[$this->currentKey] = new AttributeNode($range);
        $this->currentNode = $this->currentKey;
    }

    private function handleValueKey(Range $range): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->value = new KeywordNode($range);
        } else {
            $this->currentType->attributes[$this->currentNode] = new AttributeNode($range);
        }
    }

    private function handleIdKey(Range $range): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->id = new KeywordNode($range);
        } else {
            $this->currentType->attributes[$this->currentNode] = new AttributeNode($range);
        }
    }

    private function handleValueEntry(Range $range, mixed $value): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->updateValue($range, $value);
        } else {
            $this->currentType->attributes[$this->currentNode]->valueRange = $range;
        }
    }

    private function handleIdEntry(Range $range, mixed $value): void
    {
        if ($this->currentNode instanceof TypeNode) {
            $this->currentType->updateId($range, $value);
        } else {
            $this->currentType->attributes[$this->currentNode]->valueRange = $range;
        }
    }
}
