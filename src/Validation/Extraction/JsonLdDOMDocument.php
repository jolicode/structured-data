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
    protected string $source;

    /** @var \DOMXPath */
    protected $rawXpath;

    /** @var \DOMXPath */
    protected $xpath;

    public function __construct(string $version = '1.0', string $encoding = '')
    {
        $this->preserveWhiteSpace = true;
        $this->strictErrorChecking = false;

        return parent::__construct($version, $encoding);
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

    public function loadFromString(string $source): self
    {
        $this->source = $source;
        $html5 = new HTML5([
            'disable_html_ns' => true,
            'target_document' => $this,
        ]);

        return $html5->loadHTML($source);
    }

    private function xpath(): \DOMXPath
    {
        if (!isset($this->xpath)) {
            $this->xpath = new \DOMXPath($this);
        }

        return $this->xpath;
    }
}
