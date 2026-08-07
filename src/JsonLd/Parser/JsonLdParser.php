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
    /**
     * Maximum number of parsed documents kept in memory. Parsed structures carry a
     * Range object for every key and value, so without a bound a long-lived process
     * parsing many distinct documents would grow this cache indefinitely.
     */
    private const PARSE_CACHE_MAX_ENTRIES = 32;

    /** @var array<string, AbstractStructure|null> */
    private array $parseCache = [];

    public function __construct(
        private readonly PositionAwareJsonParser $positionAwareParser = new PositionAwareJsonParser(),
    ) {
    }

    /**
     * This method takes a json_encoded user input and builds a PHP representation of the JSON-LD document.
     */
    public function parse(JsonLdElement $jsonLdElement): ?AbstractStructure
    {
        $cacheKey = md5($jsonLdElement->content . "\0" . $jsonLdElement->startLine . "\0" . $jsonLdElement->startColumn);

        if (\array_key_exists($cacheKey, $this->parseCache)) {
            return $this->parseCache[$cacheKey];
        }

        // Well-formed documents go through the fast single-pass parser; malformed
        // ones fall back to the streaming parser, whose errors carry the position
        // of the failure.
        if (null !== json_decode($jsonLdElement->content) || 'null' === trim($jsonLdElement->content)) {
            $result = $this->positionAwareParser->parse(
                $jsonLdElement->content,
                $jsonLdElement->startLine,
                $jsonLdElement->startColumn,
            );
        } else {
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

            $result = $listener->getResult();
        }

        $this->parseCache[$cacheKey] = $result;

        while (\count($this->parseCache) > self::PARSE_CACHE_MAX_ENTRIES) {
            unset($this->parseCache[array_key_first($this->parseCache)]);
        }

        return $result;
    }
}
