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
 * Parses an HTML body into a DOMDocument, memoizing the last parsed document.
 *
 * A single loader instance is shared by all the HTML-based extractors of an
 * ExtractorsContainer, so that when several extractors (microdata, RDFa) process
 * the same page body during one extraction pass, the body is only parsed once.
 *
 * The memo holds a single slot and can be released with reset(), which the
 * extraction pipeline calls once an extraction pass is over - a long-lived
 * process does not keep the last processed document pinned in memory.
 */
class HtmlDocumentLoader
{
    private ?string $lastBody = null;

    private ?\DOMDocument $lastDocument = null;

    /**
     * Parses $body into a DOMDocument, suppressing libxml noise.
     *
     * @param string $formatName a human-readable format name, used in error messages
     *
     * @throws ExtractionException when the HTML cannot be loaded at all
     */
    public function load(string $body, string $formatName): \DOMDocument
    {
        if ($this->lastBody === $body && null !== $this->lastDocument) {
            return $this->lastDocument;
        }

        $document = new \DOMDocument();

        set_error_handler(static fn (): bool => true);

        try {
            $loaded = $document->loadHTML($body, \LIBXML_NOERROR | \LIBXML_NOWARNING | \LIBXML_NONET);
        } finally {
            restore_error_handler();
        }

        if (false === $loaded) {
            throw new ExtractionException(\sprintf('Invalid %s document: malformed HTML content.', $formatName));
        }

        $this->lastBody = $body;
        $this->lastDocument = $document;

        return $document;
    }

    public function reset(): void
    {
        $this->lastBody = null;
        $this->lastDocument = null;
    }
}
