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

use Jolicode\JsonLd\Parser\Nodes\TypeNode;
use Jolicode\JsonLd\Parser\PointerListener\ExpandedPointerListener;
use JsonStreamingParser\Parser;

class UserEntryParser
{
    public function parse(string $json, int $startLineNumber = 0): TypeNode
    {
        $listener = new ExpandedPointerListener($startLineNumber);

        try {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $json);
            rewind($stream);

            $parser = new Parser($stream, $listener);
            $parser->parse();
        } catch (\Exception $e) {
            throw $e;
        }

        return $listener->getRootType();
    }
}
