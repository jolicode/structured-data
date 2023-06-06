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

use JsonStreamingParser\Parser;

class UserEntryParser
{
    /**
     * This method takes an expanded json string and builds a PHP representation of the JSON-LD document.
     *
     * @return array<TypeNode>
     */
    public function parse(array $expandedResult, int $startLineNumber = 0): array
    {
        $listener = new PointerListener($startLineNumber);
        $typesRepresentations = [];

        foreach ($expandedResult as $type) {
            try {
                $stream = fopen('php://memory', 'r+');
                fwrite($stream, json_encode($type, \JSON_PRETTY_PRINT));
                rewind($stream);

                $parser = new Parser($stream, $listener);
                $parser->parse();
            } catch (\Exception $e) {
                throw $e;
            }

            $typesRepresentations[] = $listener->getRootType();
            fclose($stream);
        }

        return $typesRepresentations;
    }
}
