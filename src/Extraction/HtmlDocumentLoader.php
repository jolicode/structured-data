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
 * Parses an HTML body with PHP's HTML5 parser, memoizing the last parsed document.
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

    private ?\Dom\HTMLDocument $lastDocument = null;

    private ?HtmlSourceLocator $lastLocator = null;

    /**
     * Parses $body as HTML5: malformed markup is recovered from, never refused.
     *
     * The encoding is the one the page declares (BOM, then meta charset), and
     * UTF-8 when it declares none.
     */
    public function load(string $body): \Dom\HTMLDocument
    {
        if ($this->lastBody === $body && null !== $this->lastDocument) {
            return $this->lastDocument;
        }

        $document = \Dom\HTMLDocument::createFromString($body, \LIBXML_NOERROR);

        $this->lastBody = $body;
        $this->lastDocument = $document;
        $this->lastLocator = null;

        return $document;
    }

    /**
     * Locates the elements of the document parsed from $body in that body,
     * sharing the memoized document and its source scan between extractors.
     */
    public function locator(string $body): HtmlSourceLocator
    {
        $document = $this->load($body);

        return $this->lastLocator ??= new HtmlSourceLocator($body, $document);
    }

    public function reset(): void
    {
        $this->lastBody = null;
        $this->lastDocument = null;
        $this->lastLocator = null;
    }
}
