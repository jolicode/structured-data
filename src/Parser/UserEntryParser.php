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
use Jolicode\JsonLd\Parser\Nodes\TypeNode;
use JsonStreamingParser\Parser;

class UserEntryParser
{
    /**
     * This method takes a json_encoded user input and builds a PHP representation of the JSON-LD document.
     *
     * @return array<TypeNode>
     */
    public function parse(string $json): AbstractStructure
    {
        $listener = new PointerListener();

        try {
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $json);
            rewind($stream);

            $parser = new Parser($stream, $listener);
            $parser->parse();
        } catch (\Exception $e) {
            throw $e;
        }

        return $listener->getResult();
    }
}
