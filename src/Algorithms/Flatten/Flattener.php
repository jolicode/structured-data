<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Flatten;

use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\DocumentLoader;
use Jolicode\JsonLd\Algorithms\JsonLd\FramingKeyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\Services\IdentifierGenerator;

class Flattener
{
    private IdentifierGenerator $identifierGenerator;
    private NodeMapGenerator $nodeMapGenerator;

    public function __construct()
    {
        $this->identifierGenerator = new IdentifierGenerator();
        $this->nodeMapGenerator = new NodeMapGenerator($this->identifierGenerator);
    }

    public function parseJson(string $json, mixed $context = null, ProcessorOptions $options = new ProcessorOptions()): ?string
    {
        $element = json_decode($json);

        $baseUrl = $options->base;

        if (\is_string($element)) {
            $baseUrl = $element;

            $documentLoader = new DocumentLoader($baseUrl);
            $element = $documentLoader->load();
        }

        $activeContext = new Context(
            baseIri: $baseUrl,
            baseUrl: $baseUrl,
        );

        // The specs say to set ordered to false but the tests expect it to be true so...
        $options->ordered = true;

        $expander = new Expander();
        $expandedInput = $expander->expand($element, $options, activeContext: $activeContext);

        // TODO: if context is not null, use the compaction algorithm.
        // See https://www.w3.org/TR/json-ld-api/#the-jsonldprocessor-interface in flatten() 6.1

        return json_encode($this->flatten($expandedInput, $options->ordered), \JSON_PRETTY_PRINT);
    }

    /**
     * Takes a json_decoded JSON element as input and returns a flattened JSON string.
     *
     * Implementation of the Flattening Algorithm algorithm : https://www.w3.org/TR/json-ld11-api/#algorithm-9
     * It is based on the 16th July 2020 recommendation.
     */
    public function flatten(\stdClass|array|null $element, bool $ordered = false): array
    {
        // 1
        $nodeMap = [FramingKeyword::DEFAULT->value => []];

        // 2
        $this->nodeMapGenerator->buildNode($element, $nodeMap);

        // 3
        $defaultGraph = $nodeMap[FramingKeyword::DEFAULT->value];

        // 4
        if ($ordered) {
            ksort($nodeMap);
        }

        // 4
        foreach ($nodeMap as $graphName => $graph) {
            // 4
            if (FramingKeyword::DEFAULT->value === $graphName) {
                continue;
            }

            // 4.1
            if (!\array_key_exists($graphName, $defaultGraph)) {
                $defaultGraph[$graphName] = [FramingKeyword::ID->value => $graphName];
            }

            // 4.2
            $entry = &$defaultGraph[$graphName];

            // 4.3
            $entry[FramingKeyword::GRAPH->value] = [];

            // 4.4
            if ($ordered) {
                ksort($graph);
            }

            // 4.4
            foreach ($graph as $node) {
                if (1 === \count($node) && \array_key_exists(FramingKeyword::ID->value, $node)) {
                    continue;
                }

                $entry[FramingKeyword::GRAPH->value][] = $node;
            }
        }

        // 5
        $flattened = [];

        // 6
        if ($ordered) {
            ksort($defaultGraph);
        }

        // 6
        foreach ($defaultGraph as $node) {
            if (1 === \count($node) && \array_key_exists(FramingKeyword::ID->value, $node)) {
                continue;
            }

            $flattened[] = $node;
        }

        // 7
        return $flattened;
    }
}
