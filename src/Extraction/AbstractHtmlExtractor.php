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

/**
 * Base class for extractors that parse structured data from HTML DOM trees.
 *
 * Provides shared helpers for loading an HTML document into a DOMDocument and
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
     * Parses $body into a DOMDocument, suppressing libxml noise.
     *
     * @throws \RuntimeException when the HTML cannot be loaded at all
     */
    protected function loadDocument(string $body): \DOMDocument
    {
        return $this->documentLoader->load($body, $this->getFormatName());
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
     * Encodes one extracted item into a JsonLdElement anchored on its DOM node.
     *
     * @throws ExtractionException when the item cannot be encoded
     */
    protected function encodeAsJsonLdElement(\DOMElement $node, mixed $item, string $encodeFailureMessage): JsonLdElement
    {
        $encoded = json_encode($item, \JSON_UNESCAPED_SLASHES);

        if (false === $encoded) {
            throw new ExtractionException($encodeFailureMessage);
        }

        return new JsonLdElement(max(0, $node->getLineNo() - 1), 0, $encoded, $this->getFormat());
    }

    /**
     * Reports that no element could be extracted, pointing at the candidate nodes.
     *
     * @param array<\DOMElement> $nodes
     *
     * @throws ExtractionException
     */
    protected function throwEmptyResult(array $nodes, string $message): never
    {
        $lineNumbers = array_values(
            array_map(static fn (\DOMElement $node): int => $node->getLineNo(), $nodes),
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
}
