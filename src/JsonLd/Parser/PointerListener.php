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

use Jolicode\JsonLd\Parser\DataStructures\AbstractStructure;
use Jolicode\JsonLd\Parser\DataStructures\ArrayStructure;
use Jolicode\JsonLd\Parser\DataStructures\ObjectStructure;
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
        $this->adjustFilePosition($key);
        $endPosition = $this->getCurrentPosition();
        $startPosition = clone $endPosition;
        $startPosition->column -= mb_strlen($key);

        if ($this->currentStructure instanceof ObjectStructure) {
            $this->currentStructure->addKey($key, new Range($startPosition, $endPosition));
        }
    }

    public function value($value): void
    {
        if (\is_string($value)) {
            $this->adjustFilePosition($value);
        }

        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= mb_strlen((string) $value);

        $this->currentStructure?->addValue($value, new Range($start, $end));
    }

    private function adjustFilePosition(string $string): void
    {
        $this->currentColumnAdjustment += mb_strlen($string) - \strlen($string);
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

            if (null !== $parent->getLastValue()?->range) {
                $parent->getLastValue()->range->end = $currentPosition;
            }

            unset($this->currentStructure->belongsTo);
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
