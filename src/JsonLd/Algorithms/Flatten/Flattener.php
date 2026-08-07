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

use Jolicode\JsonLd\Algorithms\Compact\Compactor;
use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use Jolicode\JsonLd\Algorithms\Http\HttpDocumentLoader;
use Jolicode\JsonLd\Algorithms\JsonLd\FramingKeyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\Services\IdentifierGenerator;

class Flattener
{
    private IdentifierGenerator $identifierGenerator;
    private NodeMapGenerator $nodeMapGenerator;

    private readonly Expander $expander;
    private readonly Compactor $compactor;
    private readonly DocumentLoaderInterface $documentLoader;

    public function __construct(
        ?Expander $expander = null,
        ?Compactor $compactor = null,
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $this->documentLoader = $documentLoader ?? new HttpDocumentLoader();
        $this->expander = $expander ?? new Expander(documentLoader: $this->documentLoader);
        $this->compactor = $compactor ?? new Compactor(documentLoader: $this->documentLoader);
        $this->identifierGenerator = new IdentifierGenerator();
        $this->nodeMapGenerator = new NodeMapGenerator($this->identifierGenerator);
    }

    public function flatten(
        string $json,
        mixed $context = null,
        ProcessorOptions $options = new ProcessorOptions(),
    ): ?string {
        $element = json_decode($json);

        $baseUrl = $options->base;

        if (\is_string($element)) {
            $baseUrl = $element;

            $element = $this->documentLoader->load($baseUrl);
        }

        $activeContext = new Context(
            baseIri: $baseUrl,
            baseUrl: $baseUrl,
            processingMode: $options->processingMode,
        );

        // The specs say to set ordered to false but the tests expect it to be true so...
        $options->ordered = true;

        $expandedInput = $this->expander->doExpand($element, $options, activeContext: $activeContext);

        $flattened = $this->doFlatten($expandedInput, $options->ordered);

        // 6.1: if context is not null, the flattened output is compacted against it.
        if (null !== $context) {
            return \is_string($compacted = $this->compactor->compact(
                (string) json_encode($flattened),
                $context,
                $options,
            )) ? $compacted : null;
        }

        return json_encode($flattened, \JSON_PRETTY_PRINT) ?: null;
    }

    /**
     * Takes a json_decoded JSON element as input and returns a flattened JSON string.
     *
     * This is a PHP implementation of the Flattening algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld11-api/#algorithm-9
     */
    public function doFlatten(\stdClass|array|null $element, bool $ordered = false): array
    {
        // 1
        /** @var array<string, array<string, array<string, mixed>>|null> $nodeMap */
        $nodeMap = [FramingKeyword::DEFAULT->value => []];

        // 2
        $this->nodeMapGenerator->buildNode($element, $nodeMap);

        // 3
        /** @var array<string, array<string, mixed>> $defaultGraph */
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

            if (null === $graph) {
                continue;
            }

            // 4.1
            if (!\array_key_exists($graphName, $defaultGraph)) {
                $defaultGraph[$graphName] = [FramingKeyword::ID->value => $graphName];
            }

            // 4.2
            // 4.3
            $defaultGraph[$graphName][FramingKeyword::GRAPH->value] = [];

            // 4.4
            if ($ordered) {
                ksort($graph);
            }

            // 4.4
            foreach ($graph as $node) {
                if (1 === \count($node) && \array_key_exists(FramingKeyword::ID->value, $node)) {
                    continue;
                }

                /** @var array<string, mixed> $graphNode */
                $graphNode = $defaultGraph[$graphName];
                /** @var array<int, array<string, mixed>> $graphNodes */
                $graphNodes = $graphNode[FramingKeyword::GRAPH->value];
                $graphNodes[] = $node;
                $graphNode[FramingKeyword::GRAPH->value] = $graphNodes;
                $defaultGraph[$graphName] = $graphNode;
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
