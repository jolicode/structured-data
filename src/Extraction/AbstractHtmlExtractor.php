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

use JoliCode\StructuredData\JsonLd\Parser\Range;

/**
 * Base class for extractors that parse structured data from HTML DOM trees.
 *
 * Provides shared helpers for loading an HTML document into a Dom\HTMLDocument and
 * for building line-location hints for diagnostic messages.
 * Concrete subclasses must declare their format so that error messages remain
 * format-specific.
 */
abstract class AbstractHtmlExtractor implements FormatExtractorInterface
{
    public function __construct(
        protected readonly HtmlDocumentLoader $documentLoader = new HtmlDocumentLoader(),
    ) {
    }

    abstract public function getFormat(): ExtractorFormat;

    protected function getFormatName(): string
    {
        return $this->getFormat()->displayName();
    }

    /**
     * Parses $body with the HTML5 parser, which never rejects a document.
     */
    protected function loadDocument(string $body): \Dom\HTMLDocument
    {
        return $this->documentLoader->load($body);
    }

    /**
     * Locates, in $body, the elements of the document loadDocument() parsed
     * from it.
     */
    protected function loadLocator(string $body): HtmlSourceLocator
    {
        return $this->documentLoader->locator($body);
    }

    /**
     * The start tag of the element, or its whole line when the start tag
     * cannot be located.
     */
    protected static function anchorOf(HtmlSourceLocator $locator, \Dom\Element $element): Range
    {
        return $locator->startTag($element) ?? $locator->line($element);
    }

    /**
     * Collects the descendants of $root matching $isProperty, in document order,
     * as both the microdata and RDFa specifications order property values. The
     * descendants of an element for which $stopsAt is true are not visited.
     *
     * @param callable(\Dom\Element): bool $isProperty
     * @param callable(\Dom\Element): bool $stopsAt
     *
     * @return list<\Dom\Element>
     */
    protected static function collectInDocumentOrder(\Dom\Element $root, callable $isProperty, callable $stopsAt): array
    {
        $propertyNodes = [];
        // A stack rather than recursion, for deeply nested pages; children are
        // pushed last first, so that the first one is visited first.
        $stack = array_reverse(self::childElements($root));

        while ($stack) {
            $node = array_pop($stack);

            if ($isProperty($node)) {
                $propertyNodes[] = $node;
            }

            if ($stopsAt($node)) {
                continue;
            }

            foreach (array_reverse(self::childElements($node)) as $child) {
                $stack[] = $child;
            }
        }

        return $propertyNodes;
    }

    /**
     * Groups the values found for each property name into the properties of an
     * item, and the source map of those properties.
     *
     * A name found once holds its value; a name found several times holds the
     * list of its values, in document order.
     *
     * @param array<string, non-empty-list<array{value: mixed, map: SourceMap, key: Range}>> $occurrences the values of each name, in document order
     *
     * @return array{array<string, mixed>, SourceMap}
     */
    protected static function buildProperties(array $occurrences): array
    {
        $properties = [];
        $sourceMap = new SourceMap();

        foreach ($occurrences as $name => $values) {
            $pointer = SourceMap::pointerSegment($name);
            $sourceMap->setKey($pointer, $values[0]['key']);

            if (1 === \count($values)) {
                $properties[$name] = $values[0]['value'];
                $sourceMap->merge($values[0]['map'], $pointer);

                continue;
            }

            $properties[$name] = array_column($values, 'value');
            // The list as a whole is anchored on its first value.
            $sourceMap->setValue($pointer, $values[0]['map']->getValue(''));

            foreach ($values as $index => $value) {
                $sourceMap->merge($value['map'], $pointer . SourceMap::pointerSegment($index));
            }
        }

        return [$properties, $sourceMap];
    }

    /**
     * Builds a human-readable location suffix like " at line 42" or
     * " at lines 12, 34" from a list of DOM node line numbers.
     * Returns an empty string when $lineNumbers is empty or all-zero.
     *
     * @param list<int> $lineNumbers
     */
    protected function formatLineHint(array $lineNumbers): string
    {
        $lineNumbers = array_values(
            array_unique(
                array_filter($lineNumbers, static fn (int $lineNumber): bool => $lineNumber > 0),
            ),
        );

        if ([] === $lineNumbers) {
            return '';
        }

        return 1 === \count($lineNumbers)
            ? \sprintf(' at line %d', $lineNumbers[0])
            : \sprintf(' at lines %s', implode(', ', $lineNumbers));
    }

    /**
     * The line an element's start tag opens on, counted from 1.
     *
     * Dom\HTMLDocument counts lines from 0.
     */
    protected static function lineOf(\Dom\Element $node): int
    {
        return $node->getLineNo() + 1;
    }

    /**
     * Encodes one extracted item into a JsonLdElement anchored on its DOM node,
     * whose $sourceMap tells where each of its keys and values comes from.
     *
     * @throws ExtractionException when the item cannot be encoded
     */
    protected function encodeAsJsonLdElement(\Dom\Element $node, mixed $item, string $encodeFailureMessage, ?SourceMap $sourceMap = null): JsonLdElement
    {
        $encoded = json_encode($item, \JSON_UNESCAPED_SLASHES);

        if (false === $encoded) {
            throw new ExtractionException($encodeFailureMessage);
        }

        // JsonLdElement counts lines from 0, as the parser does.
        return new JsonLdElement($node->getLineNo(), 0, $encoded, $this->getFormat(), $sourceMap);
    }

    /**
     * Reports that no element could be extracted, pointing at the candidate nodes.
     *
     * @param array<\Dom\Element> $nodes
     *
     * @throws ExtractionException
     */
    protected function throwEmptyResult(array $nodes, string $message): never
    {
        $lineNumbers = array_values(
            array_map(static fn (\Dom\Element $node): int => self::lineOf($node), $nodes),
        );

        throw new ExtractionException($message . $this->formatLineHint($lineNumbers) . '.', $this->formatRanges($lineNumbers));
    }

    /**
     * @param list<int> $lineNumbers
     */
    protected function formatRanges(array $lineNumbers): string
    {
        $lineNumbers = array_values(
            array_unique(
                array_filter($lineNumbers, static fn (int $lineNumber): bool => $lineNumber > 0),
            ),
        );

        return implode(', ',
            array_map(
                static fn (int $lineNumber): string => \sprintf('line %d', $lineNumber),
                $lineNumbers,
            ),
        );
    }

    /**
     * @return list<\Dom\Element>
     */
    private static function childElements(\Dom\Element $node): array
    {
        $children = [];

        foreach ($node->childNodes as $childNode) {
            if ($childNode instanceof \Dom\Element) {
                $children[] = $childNode;
            }
        }

        return $children;
    }
}
