<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser\PointerListener;

use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Parser\Position;
use Jolicode\JsonLd\Parser\SourceMap;
use Jolicode\JsonLd\Parser\Elements\Type;
use JsonStreamingParser\Listener\IdleListener;
use JsonStreamingParser\Listener\PositionAwareInterface;

class CompactedPointerListener extends IdleListener implements PositionAwareInterface
{
    public function __construct(
        private int $startLineNumber = 0,
        private ?int $currentColumn = null,
        private ?int $currentLine = null,
        private ?Type $rootType = null,
        private ?Type $currentType = null,
        private string|int|null $currentKey = null,
    ) {
    }

    public function getSourceMap(): SourceMap
    {
        return new SourceMap($this->rootType);
    }

    public function startDocument(): void
    {
        $this->currentLine = 0;
        $this->currentColumn = 0;
        $this->rootType = new Type();
        $this->currentType = $this->rootType;
    }

    public function endDocument(): void
    {
        $this->rootType = $this->rootType->children[0];
    }

    public function startObject(): void
    {
        $this->currentType->children[] = $nestedType = new Type(parent: $this->currentType);
        $this->currentType = $nestedType;
    }

    public function endObject(): void
    {
        $this->currentType = $this->currentType->parent;
    }

    public function setFilePosition(int $lineNumber, int $charNumber): void
    {
        $this->currentLine = $lineNumber;
        $this->currentColumn = $charNumber;
    }

    public function key(string|int $key): void
    {
        $endPosition = $this->getCurrentPosition();
        $startPosition = clone $endPosition;
        $startPosition->column -= \strlen($key);

        $this->currentKey = $key;

        $this->currentType->handleNewKey($key, new Range($startPosition, $endPosition));
    }

    public function value(mixed $value): void
    {
        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= \strlen($value);

        $this->currentType->handleNewValue($this->currentKey, $value, new Range($start, $end));
    }

    private function getCurrentPosition(): Position
    {
        return new Position($this->currentLine + $this->startLineNumber, $this->currentColumn, $this->startLineNumber < 0);
    }
}
