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
use JsonStreamingParser\ParserHelper;

/**
 * A single-pass, position-tracking JSON parser producing the same structures
 * (and the exact same line/column ranges) as the streaming-parser based
 * PointerListener, an order of magnitude faster.
 *
 * It assumes the input is valid JSON: JsonLdParser validates the document with
 * json_decode() first and falls back to the streaming parser for its error
 * reporting when it is not.
 */
final class PositionAwareJsonParser
{
    private string $json;

    private int $length = 0;

    /**
     * Current 1-based line inside the JSON document.
     */
    private int $line = 1;

    /**
     * Byte offset at which the current line starts.
     */
    private int $lineStart = 0;

    /**
     * Cumulated difference between character and byte lengths of the string
     * tokens processed on the current line, so that columns count characters.
     */
    private int $columnAdjustment = 0;

    private int $startLine = 0;

    private int $startColumn = 0;

    private ?AbstractStructure $currentStructure = null;

    /**
     * Byte offset of the first byte after the last parsed structure.
     */
    private int $cursor = 0;

    public function parse(string $json, int $startLine = 0, int $startColumn = 0): ?AbstractStructure
    {
        $this->json = $json;
        $this->length = \strlen($json);
        $this->line = 1;
        $this->lineStart = 0;
        $this->columnAdjustment = 0;
        $this->startLine = $startLine;
        $this->startColumn = $startColumn;
        $this->currentStructure = null;
        $this->cursor = 0;

        $offset = $this->skipWhitespace(0);

        if ($offset >= $this->length) {
            return null;
        }

        $byte = $json[$offset];

        if ('{' !== $byte && '[' !== $byte) {
            return null;
        }

        return $this->parseStructure($offset);
    }

    /**
     * Parses the object or array starting at $offset, leaving the cursor on the
     * first byte after it.
     */
    private function parseStructure(int $offset): AbstractStructure
    {
        $isObject = '{' === $this->json[$offset];

        // The structure range starts at the opening bracket; the same Range
        // instance is shared with the value entry of the parent structure.
        $range = new Range($this->position($offset), null);
        $structure = $isObject
            ? new ObjectStructure($this->currentStructure, $range)
            : new ArrayStructure($this->currentStructure, $range);

        $this->currentStructure?->addValue($structure, $range);
        $this->currentStructure = $structure;

        $offset = $this->skipWhitespace($offset + 1);
        $expectingValue = !$isObject;

        while ($offset < $this->length) {
            $byte = $this->json[$offset];

            if ($isObject ? '}' === $byte : ']' === $byte) {
                // The end position is the column just after the closing bracket.
                $endPosition = $this->position($offset);
                ++$endPosition->column;
                $range->end = $endPosition;
                $this->currentStructure = $structure->belongsTo;
                $structure->belongsTo = null;
                $this->cursor = $offset + 1;

                return $structure;
            }

            if (',' === $byte) {
                $expectingValue = !$isObject;
                $offset = $this->skipWhitespace($offset + 1);

                continue;
            }

            if (':' === $byte) {
                $expectingValue = true;
                $offset = $this->skipWhitespace($offset + 1);

                continue;
            }

            if ($structure instanceof ObjectStructure && !$expectingValue) {
                // An object key.
                [$offset, $decoded, $keyRange] = $this->parseString($offset);
                $structure->addKey($decoded, $keyRange);
                $offset = $this->skipWhitespace($offset);

                continue;
            }

            $offset = $this->parseValue($offset);
            $offset = $this->skipWhitespace($offset);
        }

        $this->cursor = $offset;

        return $structure;
    }

    /**
     * Parses any JSON value starting at $offset, returning the offset of the
     * first byte after it.
     */
    private function parseValue(int $offset): int
    {
        $byte = $this->json[$offset];

        if ('{' === $byte || '[' === $byte) {
            $this->parseStructure($offset);

            return $this->cursor;
        }

        if ('"' === $byte) {
            [$offset, $decoded, $range] = $this->parseString($offset);
            $this->currentStructure?->addValue($decoded, $range);

            return $offset;
        }

        if ('t' === $byte || 'f' === $byte || 'n' === $byte) {
            $literalLength = 't' === $byte || 'n' === $byte ? 4 : 5;
            $value = match ($byte) {
                't' => true,
                'f' => false,
                default => null,
            };

            // The end position is the last character of the literal; the start is
            // computed from the string representation of the PHP value, exactly
            // like the streaming parser did.
            $end = $this->position($offset + $literalLength - 1);
            $start = clone $end;
            $start->column -= \strlen((string) $value);
            $this->currentStructure?->addValue($value, new Range($start, $end));

            return $offset + $literalLength;
        }

        // A number, stored under its PHP string representation, exactly like the
        // implicit coercion of the streaming-parser listener did.
        $tokenLength = strspn($this->json, '-+.eE0123456789', $offset);
        $value = (string) ParserHelper::convertToNumber(substr($this->json, $offset, $tokenLength));
        $offset += $tokenLength;

        // The streaming parser only emitted the number once it consumed the byte
        // following it, newlines excluded: the end position is the first byte
        // after the number, carried over to the next line when a newline
        // directly follows.
        $endOffset = $offset;

        while ($endOffset < $this->length && "\n" === $this->json[$endOffset]) {
            ++$this->line;
            $this->lineStart = $endOffset + 1;
            $this->columnAdjustment = 0;
            ++$endOffset;
        }

        $end = $this->position($endOffset);
        $start = clone $end;
        $start->column -= \strlen((string) $value);
        $this->currentStructure?->addValue($value, new Range($start, $end));

        return $endOffset;
    }

    /**
     * Parses the string starting at $offset, returning the offset of the first
     * byte after the closing quote, the decoded value and its range.
     *
     * @return array{int, string, Range}
     */
    private function parseString(int $offset): array
    {
        $closingQuote = $offset;

        while (true) {
            $closingQuote = strpos($this->json, '"', $closingQuote + 1);

            if (false === $closingQuote) {
                // Unreachable on valid JSON.
                $closingQuote = $this->length - 1;

                break;
            }

            // The quote is escaped when preceded by an odd number of backslashes.
            $backslashes = 0;

            for ($position = $closingQuote - 1; $position > $offset && '\\' === $this->json[$position]; --$position) {
                ++$backslashes;
            }

            if (0 === $backslashes % 2) {
                break;
            }
        }

        $raw = substr($this->json, $offset, $closingQuote - $offset + 1);

        if (3 === \strlen($raw) && '\\' !== $raw[1]) {
            $decoded = $raw[1];
        } else {
            $decodedRaw = json_decode($raw);
            $decoded = \is_string($decodedRaw) ? $decodedRaw : '';
        }

        // Columns count characters, not bytes: the difference for this token
        // applies to it and to everything that follows on the same line.
        $this->columnAdjustment += mb_strlen($decoded) - \strlen($decoded);

        $end = $this->position($closingQuote);
        $start = clone $end;
        $start->column -= mb_strlen($decoded);

        return [$closingQuote + 1, $decoded, new Range($start, $end)];
    }

    private function skipWhitespace(int $offset): int
    {
        $skipped = strspn($this->json, " \t\r\n", $offset);

        if (0 === $skipped) {
            return $offset;
        }

        $lastNewline = strrpos(substr($this->json, $offset, $skipped), "\n");

        if (false !== $lastNewline) {
            $this->line += substr_count($this->json, "\n", $offset, $skipped);
            $this->lineStart = $offset + $lastNewline + 1;
            $this->columnAdjustment = 0;
        }

        return $offset + $skipped;
    }

    private function position(int $offset): Position
    {
        $column = $offset - $this->lineStart + 1 + $this->columnAdjustment;

        if (1 === $this->line) {
            $column += $this->startColumn;
        }

        return new Position($this->line + $this->startLine, $column);
    }
}
