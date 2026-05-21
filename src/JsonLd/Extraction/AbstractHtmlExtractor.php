<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Extraction;

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
    private static ?string $cachedBody = null;

    private static ?\DOMDocument $cachedDocument = null;

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
        if (self::$cachedBody === $body && null !== self::$cachedDocument) {
            return self::$cachedDocument;
        }

        $document = new \DOMDocument();

        set_error_handler(static fn (): bool => true);

        try {
            $loaded = $document->loadHTML($body, \LIBXML_NOERROR | \LIBXML_NOWARNING | \LIBXML_NONET);
        } finally {
            restore_error_handler();
        }

        if (false === $loaded) {
            throw new ExtractionException(\sprintf('Invalid %s document: malformed HTML content.', $this->getFormatName()));
        }

        self::$cachedBody = $body;
        self::$cachedDocument = $document;

        return $document;
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
