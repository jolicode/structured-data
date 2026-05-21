<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Parser;

use Jolicode\JsonLd\Extraction\JsonLdElement;
use Jolicode\JsonLd\Parser\DataStructures\AbstractStructure;
use JsonStreamingParser\Parser;

class JsonLdParser
{
    /** @var array<string, AbstractStructure|null> */
    private array $parseCache = [];

    /**
     * This method takes a json_encoded user input and builds a PHP representation of the JSON-LD document.
     */
    public function parse(JsonLdElement $jsonLdElement): ?AbstractStructure
    {
        $cacheKey = md5($jsonLdElement->content . "\0" . $jsonLdElement->startLine . "\0" . $jsonLdElement->startColumn);

        if (\array_key_exists($cacheKey, $this->parseCache)) {
            return $this->parseCache[$cacheKey];
        }

        $listener = new PointerListener(
            startLineNumber: $jsonLdElement->startLine,
            startColumnNumber: $jsonLdElement->startColumn,
        );

        $stream = fopen('php://memory', 'r+');

        if (false === $stream) {
            throw new \RuntimeException('Could not open memory stream');
        }

        fwrite($stream, $jsonLdElement->content);
        rewind($stream);

        (new Parser($stream, $listener))->parse();

        return $this->parseCache[$cacheKey] = $listener->getResult();
    }
}
