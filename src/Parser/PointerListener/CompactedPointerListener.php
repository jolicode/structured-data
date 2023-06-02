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

use Jolicode\JsonLd\Parser\Elements\Type;
use Jolicode\JsonLd\Parser\Position;
use Jolicode\JsonLd\Parser\Range;
use Jolicode\JsonLd\Parser\SourceMap;
use JsonStreamingParser\Listener\IdleListener;
use JsonStreamingParser\Listener\PositionAwareInterface;

class CompactedPointerListener extends IdleListener implements PositionAwareInterface
{
    /**
     * @var array<string>
     */
    protected array $stack;

    private int $currentColumn;
    private int $currentLine;

    /**
     * @var array<string>
     */
    private array $keys;

    /**
     * @var array<Range>
     */
    private array $ranges;

    /**
     * @var array<Range>
     */
    private array $valueRanges;

    /**
     * @var array<int>
     */
    private array $arrayKeysStack = [];

    private Type $rootType;

    public function __construct(
        private int $startLineNumber = 0
    ) {
    }

    public function getSourceMap(): SourceMap
    {
        return new SourceMap($this->rootType, $this->ranges, $this->valueRanges);
    }

    public function startDocument(): void
    {
        $this->stack = [];
        $this->keys = [];
        $this->ranges = [];
        $this->valueRanges = [];
        $this->currentLine = 0;
        $this->currentColumn = 0;
        $this->arrayKeysStack = [];
    }

    public function startObject(): void
    {
        $this->startComplexValue('object');
    }

    public function endObject(): void
    {
        $this->endComplexValue();
    }

    public function setFilePosition(int $lineNumber, int $charNumber): void
    {
        $this->currentLine = $lineNumber;
        $this->currentColumn = $charNumber;
    }

    public function startArray(): void
    {
        $this->startComplexValue('array');
        $this->arrayKeysStack[] = 0;
    }

    public function endArray(): void
    {
        array_pop($this->arrayKeysStack);
        $this->endComplexValue();
    }

    public function key(string|int $key): void
    {
        if (\count($this->keys) > 0) {
            $suffixKey = $this->buildSuffix($key);
            $nodeKey = end($this->keys) . $suffixKey;
        } else {
            $nodeKey = (is_numeric($key)) ? sprintf('[%d]', $key) : $key;
        }

        if (!$this->isParentArray()) {
            $endPosition = $this->getCurrentPosition();
            $startPosition = clone $endPosition;
            $startPosition->column -= \strlen($key);
            $this->addRange($nodeKey, $startPosition, $endPosition);
        }

        $this->keys[] = $nodeKey;
    }

    public function value(mixed $value): void
    {
        if ($this->isParentArray()) {
            $counter = array_pop($this->arrayKeysStack);
            $this->addValueRange(end($this->keys), $value, $counter);
            $this->arrayKeysStack[] = ++$counter;
        } else {
            $this->addValueRange(end($this->keys), $value);
            array_pop($this->keys);
        }
    }

    protected function startComplexValue(string $type): void
    {
        if ($this->isParentArray()) {
            $counter = array_pop($this->arrayKeysStack);
            $this->key($counter);
            $this->arrayKeysStack[] = ++$counter;
        }

        $this->stack[] = $type;
    }

    protected function endComplexValue(): void
    {
        array_pop($this->stack);

        if (!empty($this->stack)) {
            array_pop($this->keys);
        }
    }

    private function isParentArray(): bool
    {
        return \count($this->stack) > 0 && 'array' === end($this->stack);
    }

    private function addRange(string $key, Position $start, Position $end = null)
    {
        $this->ranges[$key] = new Range($start, $end ?: $this->getCurrentPosition());
    }

    private function addValueRange(string $key, string $value, string $suffix = ''): void
    {
        $valueKey = $key;

        if ('' !== $suffix) {
            $valueKey .= $this->buildSuffix($suffix);
        }

        if (\array_key_exists($key, $this->ranges)) {
            $end = $this->getCurrentPosition();
            $start = clone $end;

            if (\is_string($value)) {
                // $value = html_entity_decode($value, ENT_COMPAT);
            }

            $start->column -= \strlen($value);
            $this->valueRanges[$valueKey] = new Range($start, $end);
        }
    }

    private function buildSuffix(int|string $key): string
    {
        return (is_numeric($key)) ? sprintf('[%d]', $key) : '.' . $key;
    }

    private function getCurrentPosition(): Position
    {
        return new Position($this->currentLine + $this->startLineNumber, $this->currentColumn, $this->startLineNumber < 0);
    }
}
