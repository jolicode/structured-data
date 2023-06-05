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

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Parser\Nodes\TypeNode;
use JsonStreamingParser\Parser;

class UserEntryParser
{
    public function parse(string $json, int $startLineNumber = 0): TypeNode
    {
        $expander = new Expander();
        $expandedEntry = $expander->parseJson($json);

        $listener = new PointerListener($startLineNumber);

        try {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $expandedEntry);
            rewind($stream);

            $parser = new Parser($stream, $listener);
            $parser->parse();
        } catch (\Exception $e) {
            throw $e;
        }

        return $listener->getRootType();
    }
}
