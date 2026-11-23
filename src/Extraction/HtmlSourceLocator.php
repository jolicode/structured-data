<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Extraction;

use JoliCode\StructuredData\JsonLd\Parser\Position;
use JoliCode\StructuredData\JsonLd\Parser\Range;
use JoliCode\StructuredData\JsonLd\Parser\Utf16;

/**
 * Finds where the elements of a parsed HTML document are written in its source.
 *
 * Dom\HTMLDocument only tells the line an element starts on, never its column,
 * and nothing about its attributes or text. This class scans the source once
 * with a small tolerant tokenizer, recording every start tag with the offsets
 * of its attributes and of its matching end tag, then pairs each element of
 * the DOM with its tag.
 *
 * An element is paired by its line, its name and its structured data
 * attributes, then by its rank among the elements sharing all three: the HTML5
 * parser adds elements of its own (html, body, tbody, clones of misnested
 * formatting elements) and moves some (foster parenting), so a plain count of
 * the tags would drift. Only elements carrying a structured data attribute are
 * paired, the only ones the extractors ask about. An element that cannot be
 * paired is not located: callers fall back to its line.
 *
 * Lines are counted from 1 and columns from 1, in UTF-16 code units, as the
 * editors displaying them count them. Ranges end on the column just after
 * their last character.
 */
final class HtmlSourceLocator
{
    private const SIGNATURE_ATTRIBUTES = ['itemprop', 'itemscope', 'itemtype', 'itemid', 'property', 'typeof', 'about', 'resource', 'vocab', 'prefix'];

    private const VOID_ELEMENTS = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];

    /**
     * Elements whose content is text up to their end tag, never markup.
     */
    private const RAW_TEXT_ELEMENTS = ['script', 'style', 'xmp', 'iframe', 'noembed', 'noframes', 'textarea', 'title'];

    private const WHITESPACE = " \t\n\f\r";

    private const TRIMMED_CHARACTERS = " \t\n\r\0\x0B";

    /**
     * Bytes between two column checkpoints of a line.
     */
    private const COLUMN_CHECKPOINT_SPACING = 1024;

    /**
     * @var list<array{name: string, start: int, end: int, attributes: array<string, array{nameStart: int, nameEnd: int, valueStart: ?int, valueEnd: ?int}>}>|null
     */
    private ?array $tags = null;

    /**
     * The offset of the end tag of each start tag that has one, by tag index.
     *
     * @var array<int, int>
     */
    private array $closeStarts = [];

    /**
     * @var list<int>
     */
    private array $lineStarts = [];

    /**
     * The line found by the last lookup, where the next one starts.
     */
    private int $lineCursor = 0;

    /**
     * Known columns of each line, as [offset, column] pairs in increasing order.
     *
     * @var array<int, non-empty-list<array{int, int}>>
     */
    private array $columnCheckpoints = [];

    /**
     * Strong references: the DOM extension hands out the same object for a node
     * only while one is alive, so the paired elements are kept alive with the
     * locator.
     *
     * @var \SplObjectStorage<\Dom\Element, int>|null
     */
    private ?\SplObjectStorage $elementTags = null;

    public function __construct(
        private readonly string $body,
        private readonly \Dom\HTMLDocument $document,
    ) {
    }

    /**
     * The start tag of the element, from its "<" to its ">".
     */
    public function startTag(\Dom\Element $element): ?Range
    {
        $tag = $this->tagOf($element);

        return null === $tag ? null : $this->range($tag['start'], $tag['end']);
    }

    /**
     * The whole line the element starts on, for an element that cannot be
     * located more precisely.
     */
    public function line(\Dom\Element $element): Range
    {
        $this->tokenize();

        $lineIndex = min(max(0, $element->getLineNo()), \count($this->lineStarts) - 1);
        $lineStart = $this->lineStarts[$lineIndex];
        $lineEnd = $this->lineStarts[$lineIndex + 1] ?? \strlen($this->body);

        // The next line starts after the line break, which is not part of the
        // line; a line holds no other "\r" or "\n".
        while ($lineEnd > $lineStart && \in_array($this->body[$lineEnd - 1], ["\r", "\n"], true)) {
            --$lineEnd;
        }

        return $this->range($lineStart, $lineEnd);
    }

    /**
     * The name of an attribute of the element, "itemtype" in itemtype="…".
     */
    public function attributeName(\Dom\Element $element, string $attribute): ?Range
    {
        $location = $this->tagOf($element)['attributes'][$attribute] ?? null;

        return null === $location ? null : $this->range($location['nameStart'], $location['nameEnd']);
    }

    /**
     * The value of an attribute of the element, without its quotes and without
     * the whitespace around it, as the extractors trim it.
     */
    public function attributeValue(\Dom\Element $element, string $attribute): ?Range
    {
        $location = $this->tagOf($element)['attributes'][$attribute] ?? null;

        if (null === $location || null === $location['valueStart'] || null === $location['valueEnd']) {
            return null;
        }

        return $this->trimmedRange($location['valueStart'], $location['valueEnd']);
    }

    /**
     * The $index-th whitespace-separated token of an attribute value, counted
     * from 0: one name of itemprop="name alternateName", one type of typeof.
     */
    public function attributeToken(\Dom\Element $element, string $attribute, int $index): ?Range
    {
        $location = $this->tagOf($element)['attributes'][$attribute] ?? null;

        if (null === $location || null === $location['valueStart'] || null === $location['valueEnd']) {
            return null;
        }

        $rawValue = substr($this->body, $location['valueStart'], $location['valueEnd'] - $location['valueStart']);

        if (!preg_match_all('/[^' . preg_quote(self::WHITESPACE, '/') . ']+/', $rawValue, $matches, \PREG_OFFSET_CAPTURE) || !isset($matches[0][$index])) {
            return null;
        }

        [$token, $offset] = $matches[0][$index];
        $start = $location['valueStart'] + $offset;

        return $this->range($start, $start + \strlen($token));
    }

    /**
     * The text the element holds, from its first to its last non-whitespace
     * character: "2010" in <span itemprop="foundingYear"> 2010 </span>.
     *
     * The element must have an end tag, and what lies between its tags must
     * read as its text content: when the HTML5 parser closed it somewhere else
     * (a <p> without </p>), its text is not located.
     */
    public function text(\Dom\Element $element): ?Range
    {
        $tagIndex = $this->tagIndexOf($element);
        $closeStart = null === $tagIndex ? null : $this->closeStarts[$tagIndex] ?? null;

        if (null === $tagIndex || null === $closeStart || null === $this->tags) {
            return null;
        }

        $contentStart = $this->tags[$tagIndex]['end'];
        $innerSource = substr($this->body, $contentStart, $closeStart - $contentStart);

        if (self::normalizeText(html_entity_decode(strip_tags($innerSource), \ENT_QUOTES | \ENT_HTML5, 'UTF-8')) !== self::normalizeText($element->textContent ?? '')) {
            return null;
        }

        return $this->trimmedRange($contentStart, $closeStart);
    }

    private static function normalizeText(string $text): string
    {
        return trim((string) preg_replace('/\s+/u', ' ', $text));
    }

    /**
     * @return array{name: string, start: int, end: int, attributes: array<string, array{nameStart: int, nameEnd: int, valueStart: ?int, valueEnd: ?int}>}|null
     */
    private function tagOf(\Dom\Element $element): ?array
    {
        $tagIndex = $this->tagIndexOf($element);

        return null === $tagIndex ? null : $this->tags[$tagIndex] ?? null;
    }

    private function tagIndexOf(\Dom\Element $element): ?int
    {
        $this->pairElements();

        if (null === $this->elementTags || !$this->elementTags->offsetExists($element)) {
            return null;
        }

        return $this->elementTags[$element];
    }

    private function trimmedRange(int $start, int $end): ?Range
    {
        $value = substr($this->body, $start, $end - $start);
        $leading = \strlen($value) - \strlen(ltrim($value, self::TRIMMED_CHARACTERS));
        $trimmedLength = \strlen(trim($value, self::TRIMMED_CHARACTERS));

        if (0 === $trimmedLength) {
            return null;
        }

        return $this->range($start + $leading, $start + $leading + $trimmedLength);
    }

    private function range(int $startOffset, int $endOffset): Range
    {
        return new Range($this->position($startOffset), $this->position($endOffset));
    }

    private function position(int $offset): Position
    {
        $lineIndex = $this->lineIndexOf($offset);

        return new Position($lineIndex + 1, $this->columnOf($lineIndex, $offset));
    }

    /**
     * The column of an offset, counted from a checkpoint of its line rather
     * than from the line start: on a minified page, the whole document is one
     * line, and counting from its start for every position would be quadratic.
     */
    private function columnOf(int $lineIndex, int $offset): int
    {
        $checkpoints = $this->columnCheckpoints[$lineIndex] ?? [[$this->lineStarts[$lineIndex], 1]];
        $last = \count($checkpoints) - 1;

        // The last checkpoint at or before the offset.
        $index = $last;

        if ($checkpoints[$last][0] > $offset) {
            $low = 0;
            $high = $last;

            while ($low < $high) {
                $middle = intdiv($low + $high + 1, 2);

                if ($checkpoints[$middle][0] <= $offset) {
                    $low = $middle;
                } else {
                    $high = $middle - 1;
                }
            }

            $index = $low;
        }

        [$from, $column] = $checkpoints[$index];

        // Past the last checkpoint, new ones are laid every so often, on the
        // first byte of a character so that no character is split in two.
        while ($index === $last && $offset - $from > self::COLUMN_CHECKPOINT_SPACING) {
            $next = $from + self::COLUMN_CHECKPOINT_SPACING;

            while ($next < $offset && 0x80 === (\ord($this->body[$next]) & 0xC0)) {
                ++$next;
            }

            $column += Utf16::length(substr($this->body, $from, $next - $from));
            $from = $next;
            $checkpoints[] = [$from, $column];
            $index = ++$last;
        }

        $this->columnCheckpoints[$lineIndex] = $checkpoints;

        return $column + Utf16::length(substr($this->body, $from, $offset - $from));
    }

    /**
     * The line holding the offset, counted from 0.
     */
    private function lineIndexOf(int $offset): int
    {
        // Offsets are mostly asked for in document order: walking forward from
        // the line found last is cheaper than a search over the whole page.
        $line = $this->lineCursor;

        if ($this->lineStarts[$line] <= $offset) {
            $steps = 0;

            while (isset($this->lineStarts[$line + 1]) && $this->lineStarts[$line + 1] <= $offset && ++$steps < 64) {
                ++$line;
            }

            if (!isset($this->lineStarts[$line + 1]) || $this->lineStarts[$line + 1] > $offset) {
                return $this->lineCursor = $line;
            }
        }

        // The last line starting at or before the offset.
        $low = 0;
        $high = \count($this->lineStarts) - 1;

        while ($low < $high) {
            $middle = intdiv($low + $high + 1, 2);

            if ($this->lineStarts[$middle] <= $offset) {
                $low = $middle;
            } else {
                $high = $middle - 1;
            }
        }

        return $this->lineCursor = $low;
    }

    private function pairElements(): void
    {
        if (null !== $this->elementTags) {
            return;
        }

        $this->tokenize();
        $this->elementTags = new \SplObjectStorage();

        $tagsBySignature = [];

        foreach ($this->tags ?? [] as $index => $tag) {
            $signature = $this->sourceSignature($tag);

            if (null !== $signature) {
                $tagsBySignature[$signature][] = $index;
            }
        }

        $ranks = [];

        // In document order; walking the elements is an order of magnitude
        // faster than an XPath query testing each attribute.
        foreach ($this->document->getElementsByTagName('*') as $element) {
            $signature = $element->hasAttributes() ? $this->domSignature($element) : null;

            if (null === $signature) {
                continue;
            }

            $rank = $ranks[$signature] = ($ranks[$signature] ?? -1) + 1;

            if (isset($tagsBySignature[$signature][$rank])) {
                $this->elementTags[$element] = $tagsBySignature[$signature][$rank];
            }
        }
    }

    /**
     * @param array{name: string, start: int, end: int, attributes: array<string, array{nameStart: int, nameEnd: int, valueStart: ?int, valueEnd: ?int}>} $tag
     */
    private function sourceSignature(array $tag): ?string
    {
        $attributes = [];

        foreach (self::SIGNATURE_ATTRIBUTES as $attribute) {
            $location = $tag['attributes'][$attribute] ?? null;

            if (null === $location) {
                continue;
            }

            $value = null === $location['valueStart'] || null === $location['valueEnd']
                ? ''
                : html_entity_decode(substr($this->body, $location['valueStart'], $location['valueEnd'] - $location['valueStart']), \ENT_QUOTES | \ENT_HTML5, 'UTF-8');

            $attributes[] = $attribute . '=' . preg_replace('/\r\n?/', "\n", $value);
        }

        if ([] === $attributes) {
            return null;
        }

        return $this->lineIndexOf($tag['start']) . "\0" . $tag['name'] . "\0" . implode("\0", $attributes);
    }

    /**
     * Null for an element without any structured data attribute, which is
     * never paired.
     */
    private function domSignature(\Dom\Element $element): ?string
    {
        $attributes = [];

        foreach (self::SIGNATURE_ATTRIBUTES as $attribute) {
            if ($element->hasAttribute($attribute)) {
                $attributes[] = $attribute . '=' . $element->getAttribute($attribute);
            }
        }

        if ([] === $attributes) {
            return null;
        }

        return $element->getLineNo() . "\0" . strtolower($element->localName) . "\0" . implode("\0", $attributes);
    }

    private function tokenize(): void
    {
        if (null !== $this->tags) {
            return;
        }

        $body = $this->body;
        $length = \strlen($body);

        // Line breaks are "\r\n", "\r" or "\n", as the HTML parser and the
        // editors read them.
        $this->lineStarts = [0];

        if (preg_match_all('/\r\n|\r|\n/', $body, $matches, \PREG_OFFSET_CAPTURE)) {
            foreach ($matches[0] as [$lineBreak, $offset]) {
                $this->lineStarts[] = $offset + \strlen($lineBreak);
            }
        }

        $tags = [];
        // Indexes of the start tags still waiting for their end tag, by name.
        $openTags = [];
        // The content of a <template> is not part of the document tree.
        $templateDepth = 0;
        $offset = 0;

        while ($offset < $length && false !== ($tagOpen = strpos($body, '<', $offset))) {
            if (0 === substr_compare($body, '<!--', $tagOpen, 4)) {
                $commentEnd = strpos($body, '-->', $tagOpen + 4);
                $offset = false === $commentEnd ? $length : $commentEnd + 3;

                continue;
            }

            if (0 === substr_compare($body, '<![CDATA[', $tagOpen, 9)) {
                $cdataEnd = strpos($body, ']]>', $tagOpen + 9);
                $offset = false === $cdataEnd ? $length : $cdataEnd + 3;

                continue;
            }

            $next = $body[$tagOpen + 1] ?? '';

            // A doctype, a processing instruction or a bogus comment.
            if ('!' === $next || '?' === $next) {
                $offset = $this->afterNextGreaterThan($tagOpen + 2);

                continue;
            }

            if ('/' === $next) {
                if (!ctype_alpha($body[$tagOpen + 2] ?? '')) {
                    $offset = $this->afterNextGreaterThan($tagOpen + 2);

                    continue;
                }

                $nameLength = strcspn($body, self::WHITESPACE . '/>', $tagOpen + 2);
                $name = strtolower(substr($body, $tagOpen + 2, $nameLength));

                if ('template' === $name) {
                    $templateDepth = max(0, $templateDepth - 1);
                } elseif (0 === $templateDepth && isset($openTags[$name]) && \is_int($openTagIndex = array_pop($openTags[$name]))) {
                    $this->closeStarts[$openTagIndex] = $tagOpen;
                }

                $offset = $this->afterNextGreaterThan($tagOpen + 2 + $nameLength);

                continue;
            }

            if (!ctype_alpha($next)) {
                $offset = $tagOpen + 1;

                continue;
            }

            $nameLength = strcspn($body, self::WHITESPACE . '/>', $tagOpen + 1);
            $name = strtolower(substr($body, $tagOpen + 1, $nameLength));
            [$attributes, $tagEnd] = $this->readAttributes($tagOpen + 1 + $nameLength);

            if (0 === $templateDepth) {
                $tags[] = [
                    'name' => $name,
                    'start' => $tagOpen,
                    'end' => $tagEnd,
                    'attributes' => $attributes,
                ];

                if (!\in_array($name, self::VOID_ELEMENTS, true)) {
                    $openTags[$name][] = \count($tags) - 1;
                }
            }

            if ('template' === $name) {
                ++$templateDepth;
            }

            $offset = $tagEnd;

            if ('plaintext' === $name) {
                break;
            }

            // The content of a raw text element is skipped up to its end tag,
            // which the loop then reads as any other.
            if (\in_array($name, self::RAW_TEXT_ELEMENTS, true)) {
                $offset = preg_match('#</' . $name . '[' . preg_quote(self::WHITESPACE, '#') . '/>]#i', $body, $endTag, \PREG_OFFSET_CAPTURE, $tagEnd)
                    ? $endTag[0][1]
                    : $length;
            }
        }

        $this->tags = $tags;
    }

    /**
     * Reads the attributes of a start tag, from the end of its name, as the
     * HTML5 tokenizer does; the first of two attributes with the same name wins.
     *
     * @return array{array<string, array{nameStart: int, nameEnd: int, valueStart: ?int, valueEnd: ?int}>, int} the attributes, and the offset just after the tag
     */
    private function readAttributes(int $offset): array
    {
        $body = $this->body;
        $length = \strlen($body);
        $attributes = [];

        while (true) {
            $offset += strspn($body, self::WHITESPACE . '/', $offset);

            if ($offset >= $length) {
                return [$attributes, $length];
            }

            if ('>' === $body[$offset]) {
                return [$attributes, $offset + 1];
            }

            // An attribute name may start with "=", never end with it.
            $nameStart = $offset;
            $offset = $nameStart + 1 + strcspn($body, self::WHITESPACE . '/>=', $nameStart + 1);
            $nameEnd = $offset;
            $valueStart = null;
            $valueEnd = null;

            $afterName = $offset + strspn($body, self::WHITESPACE, $offset);

            if ('=' === ($body[$afterName] ?? '')) {
                $offset = $afterName + 1;
                $offset += strspn($body, self::WHITESPACE, $offset);
                $quote = $body[$offset] ?? '';

                if ('"' === $quote || "'" === $quote) {
                    $valueStart = $offset + 1;
                    $closingQuote = strpos($body, $quote, $valueStart);
                    $valueEnd = false === $closingQuote ? $length : $closingQuote;
                    $offset = min($length, $valueEnd + 1);
                } else {
                    $valueStart = $offset;
                    $valueEnd = $offset + strcspn($body, self::WHITESPACE . '>', $offset);
                    $offset = $valueEnd;
                }
            }

            $name = strtolower(substr($body, $nameStart, $nameEnd - $nameStart));
            $attributes[$name] ??= [
                'nameStart' => $nameStart,
                'nameEnd' => $nameEnd,
                'valueStart' => $valueStart,
                'valueEnd' => $valueEnd,
            ];
        }
    }

    private function afterNextGreaterThan(int $offset): int
    {
        $greaterThan = strpos($this->body, '>', $offset);

        return false === $greaterThan ? \strlen($this->body) : $greaterThan + 1;
    }
}
