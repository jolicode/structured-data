<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Extraction;

use Masterminds\HTML5;

class JsonLdDOMDocument extends \DOMDocument
{
    public function __construct(
        protected ?string $source = null,
        /** @var ?\DOMXPath */
        protected $rawXpath = null,
        /** @var \?DOMXPath */
        protected $xpath = null,
        string $version = '1.0',
        string $encoding = '',
    ) {
        $this->preserveWhiteSpace = true;
        $this->strictErrorChecking = false;

        parent::__construct($version, $encoding);
    }

    public function getItems(): array
    {
        $items = [];
        $reader = new \XMLReader();
        $reader->XML($this->source, null, \LIBXML_BIGLINES | \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD | \LIBXML_NOERROR | \LIBXML_NOWARNING);

        while ($reader->read()) {
            if (\XMLReader::ELEMENT === $reader->nodeType && 'script' === $reader->name && $reader->hasAttributes) {
                if ($reader->moveToAttribute('type') && 'application/ld+json' === $reader->value) {
                    $reader->moveToElement();
                    $item = @$reader->expand();

                    if ($item instanceof \DOMElement) {
                        $items[] = $item;
                    }
                }
            }
        }

        if (\count($items)) {
            return $items;
        }

        return iterator_to_array($this->xpath()->query('//script[@type=\'application/ld+json\']'));
    }

    public function fromString(string $source): self
    {
        $this->source = $source;

        $html5 = new HTML5([
            'disable_html_ns' => true,
            'target_document' => $this,
        ]);

        $html5->loadHTML($source);

        return $this;
    }

    public function getLine(\DOMElement $item)
    {
        if ($item->getLineNo() > 0) {
            return $item->getLineNo();
        }
        // attempt to get the line number from a raw DomDocument
        $rawItem = $this->getRawItem($item->getNodePath());

        return $rawItem ? $rawItem->getLineNo() : 0;
    }

    private function xpath(): \DOMXPath
    {
        if (!isset($this->xpath)) {
            $this->xpath = new \DOMXPath($this);
        }

        return $this->xpath;
    }

    private function getRawItem(string $path)
    {
        if (null === $this->rawXpath) {
            $rawDocument = new \DOMDocument();
            @$rawDocument->loadHTML($this->source);
            $this->rawXpath = new \DOMXPath($rawDocument);
        }

        return $this->rawXpath->query($path)[0];
    }
}
