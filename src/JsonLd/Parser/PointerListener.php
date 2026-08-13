<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser;

use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ArrayStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;
use JsonStreamingParser\Listener\IdleListener;
use JsonStreamingParser\Listener\PositionAwareInterface;

class PointerListener extends IdleListener implements PositionAwareInterface
{
    public function __construct(
        private int $startLineNumber = 0,
        private int $currentColumn = 0,
        private int $currentLine = 0,
        private int $startColumnNumber = 0,
        private ?AbstractStructure $currentStructure = null,
        private int $currentColumnAdjustment = 0,
    ) {
    }

    public function getResult(): ?AbstractStructure
    {
        return $this->currentStructure;
    }

    public function setFilePosition(int $lineNumber, int $charNumber): void
    {
        if ($this->currentLine !== $lineNumber) {
            $this->currentColumnAdjustment = 0;
        }

        $this->currentLine = $lineNumber;
        $this->currentColumn = $charNumber;
    }

    public function startObject(): void
    {
        $this->startStructure(ObjectStructure::class);
    }

    public function endObject(): void
    {
        $this->endStructure();
    }

    public function startArray(): void
    {
        $this->startStructure(ArrayStructure::class);
    }

    public function endArray(): void
    {
        $this->endStructure();
    }

    public function key(string $key): void
    {
        $keyLength = $this->adjustFilePosition($key);
        $endPosition = $this->getCurrentPosition();
        $startPosition = clone $endPosition;
        $startPosition->column -= $keyLength;

        if ($this->currentStructure instanceof ObjectStructure) {
            $this->currentStructure->addKey($key, new Range($startPosition, $endPosition));
        }
    }

    public function value($value): void
    {
        $valueLength = \strlen((string) $value);

        if (\is_string($value)) {
            $valueLength = $this->adjustFilePosition($value);
        }

        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= $valueLength;

        $this->currentStructure?->addValue($value, new Range($start, $end));
    }

    private function adjustFilePosition(string $string): int
    {
        $byteLength = \strlen($string);
        $characterLength = mb_strlen($string);

        $this->currentColumnAdjustment += $characterLength - $byteLength;

        return $characterLength;
    }

    private function startStructure(string $structureClass): void
    {
        if (!\in_array($structureClass, [ObjectStructure::class, ArrayStructure::class], true)) {
            throw new \InvalidArgumentException('Invalid structure class');
        }

        $range = new Range($this->getCurrentPosition(), null);
        $newStructure = new $structureClass($this->currentStructure, $range);

        if ($this->currentStructure) {
            $this->currentStructure->addValue($newStructure, $range);
        }

        $this->currentStructure = $newStructure;
    }

    private function endStructure(): void
    {
        $currentPosition = $this->getCurrentPosition();
        ++$currentPosition->column;

        if (null === $this->currentStructure) {
            throw new \RuntimeException('No structure to end');
        }

        if (null !== $this->currentStructure->range) {
            $this->currentStructure->range->end = $currentPosition;
        }

        if (isset($this->currentStructure->belongsTo)) {
            $parent = $this->currentStructure->belongsTo;
            $lastParentValue = $parent->getLastValue();

            if (null !== $lastParentValue?->range) {
                $lastParentValue->range->end = $currentPosition;
            }

            $this->currentStructure->belongsTo = null;
            $this->currentStructure = $parent;
        }
    }

    private function getCurrentPosition(): Position
    {
        $column = $this->currentColumn + $this->currentColumnAdjustment;

        if (1 === $this->currentLine) {
            $column += $this->startColumnNumber;
        }

        return new Position($this->currentLine + $this->startLineNumber, $column);
    }
}
