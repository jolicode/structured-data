<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Flatten;

use Jolicode\JsonLd\Utils\IdentifierGenerator;
use stdClass;

class Flattener
{
    private IdentifierGenerator $identifierGenerator;

    public function __construct()
    {
        $this->identifierGenerator = new IdentifierGenerator();
        $this->nodeMapGenerator = new NodeMapGenerator($this->identifierGenerator);
    }

    /**
     * Takes a json_decoded JSON string as input and returns a flattened JSON string
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld11-api/#algorithm-9. It is based on the 16th July 2020 recommendation.
     */
    public function flatten(\stdClass $input): string
    {
        $this->nodeMapGenerator->buildNode((array) $input);
        $map = $this->nodeMapGenerator->getMap();
        $defaultGraph = $map['@default'];

        foreach ($map as $graphName => $graph) {
            if ('@default' === $graphName) {
                continue;
            }

            if (!array_key_exists($graphName, $defaultGraph)) {
                $defaultGraph[$graphName] = ['@id' => $graphName];
            }

            $entry = $defaultGraph[$graphName];
            $entry['@graph'] = [];

            foreach ($graph as $node) {
                if (1 === \count($node) && array_key_exists('@id', $node)) {
                    continue;
                }

                $entry['@graph'][] = $node;
            }
        }

        $flattened = [];

        foreach ($defaultGraph as $id => $node) {
            if (1 === \count($node) && array_key_exists('@id', $node)) {
                continue;
            }

            $flattened[] = $node;
        }

        return json_encode($flattened);
    }
}
