<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser;

use JoliCode\StructuredData\Extraction\JsonLdElement;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JsonStreamingParser\Exception\ParsingException;
use JsonStreamingParser\Parser;

class JsonLdParser
{
    /**
     * Maximum number of parsed documents kept in memory. Parsed structures carry a
     * Range object for every key and value, so without a bound a long-lived process
     * parsing many distinct documents would grow this cache indefinitely.
     */
    private const PARSE_CACHE_MAX_ENTRIES = 32;

    /**
     * Documents nested more deeply than this are refused before any structure is
     * built. The parsed structure graph is a linked tree that PHP releases
     * recursively; past a few tens of thousands of levels that release overflows
     * the C stack and crashes the whole process with an uncatchable SIGSEGV. The
     * limit is therefore set far below that and comfortably above any real
     * schema.org / JSON-LD document, and matches json_decode()'s own default
     * nesting limit so both parsing paths behave consistently.
     */
    private const MAX_DEPTH = 512;

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

        // Refuse pathologically deep documents before building (and later
        // releasing) the structure graph, which happens recursively and would
        // otherwise overflow the C stack. json_decode() reports JSON_ERROR_DEPTH
        // for any document nested deeper than the limit, whether or not it is
        // otherwise well-formed, because it descends into every container before
        // checking that it is closed. This is caught before the streaming-parser
        // fallback below could build the dangerous graph.
        $decoded = json_decode($jsonLdElement->content, depth: self::MAX_DEPTH);

        if (\JSON_ERROR_DEPTH === json_last_error()) {
            throw new ParsingException($jsonLdElement->startLine, $jsonLdElement->startColumn, \sprintf('Document nesting exceeds the maximum supported depth of %d.', self::MAX_DEPTH));
        }

        // Well-formed documents go through the fast single-pass parser; malformed
        // ones fall back to the streaming parser, whose errors carry the position
        // of the failure.
        if (null !== $decoded || 'null' === trim($jsonLdElement->content)) {
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
