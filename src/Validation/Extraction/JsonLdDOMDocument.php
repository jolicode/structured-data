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
        string $encoding = ''
    ) {
        $this->preserveWhiteSpace = true;
        $this->strictErrorChecking = false;

        parent::__construct($version, $encoding);
    }

    public function getItems(): array
    {
        return iterator_to_array($this->xpath()->query('//script[@type=\'application/ld+json\']'));
    }

    public static function fromString(string $source): self
    {
        $document = new self();

        $html5 = new HTML5([
            'disable_html_ns' => true,
            'target_document' => $document,
        ]);

        $document->source = $html5->loadHTML($source)->textContent;

        return $document;
    }

    private function xpath(): \DOMXPath
    {
        if (!isset($this->xpath)) {
            $this->xpath = new \DOMXPath($this);
        }

        return $this->xpath;
    }
}
