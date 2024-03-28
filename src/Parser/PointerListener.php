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
        private ?AbstractStructure $currentStructure = null,
    ) {
    }

    public function getResult(): AbstractStructure
    {
        return $this->currentStructure;
    }

    public function setFilePosition(int $lineNumber, int $charNumber): void
    {
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
        if ($this->currentStructure instanceof ObjectStructure) {
            $endPosition = $this->getCurrentPosition();
            $startPosition = clone $endPosition;
            $startPosition->column -= \strlen($key);

            $this->currentStructure->addKey($key, new Range($startPosition, $endPosition));
        }
    }

    public function value($value): void
    {
        $end = $this->getCurrentPosition();
        $start = clone $end;
        $start->column -= \strlen($value);

        $this->currentStructure->addValue($value, new Range($start, $end));
    }

    private function startStructure(string $structureClass): void
    {
        $range = new Range($this->getCurrentPosition(), null);
        $newStructure = new $structureClass($this->currentStructure, $range);

        if ($this->currentStructure) {
            $this->currentStructure->addValue($newStructure, $range);
        }

        $this->currentStructure = $newStructure;
    }

    private function endStructure(): void
    {
        $this->currentStructure->range->end = $this->getCurrentPosition();

        if (isset($this->currentStructure->belongsTo)) {
            $this->currentStructure->belongsTo->getLastValue()->range->end = $this->getCurrentPosition();
            $parent = $this->currentStructure->belongsTo;
            unset($this->currentStructure->belongsTo);
            $this->currentStructure = $parent;
        }
    }

    private function getCurrentPosition()
    {
        return new Position($this->currentLine + $this->startLineNumber, $this->currentColumn);
    }
}
