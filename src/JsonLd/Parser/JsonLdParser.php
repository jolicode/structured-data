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

use Jolicode\JsonLd\Parser\DataStructures\AbstractStructure;
use Jolicode\SchemaOrg\Extraction\JsonLdElement;
use JsonStreamingParser\Parser;

class JsonLdParser
{
    /**
     * This method takes a json_encoded user input and builds a PHP representation of the JSON-LD document.
     */
    public function parse(JsonLdElement $jsonLdElement): ?AbstractStructure
    {
        $listener = new PointerListener(startLineNumber: $jsonLdElement->startLine);

        try {
            $stream = fopen('php://memory', 'r+');

            if (false === $stream) {
                throw new \RuntimeException('Could not open memory stream');
            }

            fwrite($stream, $jsonLdElement->content);
            rewind($stream);

            $parser = new Parser($stream, $listener);
            $parser->parse();
        } catch (\Exception $e) {
            throw $e;
        }

        return $listener->getResult();
    }
}
