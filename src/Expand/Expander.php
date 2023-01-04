<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Expand;

use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\ContextProcessing\ContextOptions;
use Jolicode\JsonLd\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Http\DocumentLoader;
use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;

class Expander
{
    public function __construct(
        private ContextProcesser $contextProcesser = new ContextProcesser(),
    ) {
    }

    public function expand(mixed $element, ProcessorOptions $options = new ProcessorOptions()): ?string
    {
        $baseUrl = $options->base;

        if (is_string($element)) {
            $baseUrl = $element;

            $documentLoader = new DocumentLoader($baseUrl);
            $element = $documentLoader->load();
        }

        $contextOptions = new ContextOptions(
            baseIri: $baseUrl,
            baseUrl: $baseUrl,
        );

        $activeContext = new Context(options: $contextOptions);

        if ($options->expandContext) {
            $localContext = new Context($options->expandContext);
            $this->contextProcesser->processContext($activeContext, $localContext, $activeContext->options->baseUrl);
        }

        return $this->process(
            $element,
            $options,
            activeContext: $activeContext,
            activeProperty: null,
            baseUrl: $baseUrl,
        );
    }

    /**
     * Takes a json_decoded JSON element as input and returns an expanded JSON string.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld-api/#expansion-algorithm. It is based on the 16th July 2020 recommendation.
     */
    private function process(
        mixed $element,
        ProcessorOptions $options,
        ?string $baseUrl = null,
        Context $activeContext = new Context(),
        ?string $activeProperty = '@default',
    ): ?string {
        // 1
        if (!$element) {
            return null;
        }

        // 2
        if ('@default' === $activeProperty) {
            $options->frameExpansion = false;
        }

        // 3
        // This is a mess, the documentation is quite hard to understand and the JS library doesn't bother with it.
        // Let's skip it for now.
        // if (array_key_exists($activeProperty, $activeContext->options->termDefinitions)) {
        //     $propertyScopedContext = $activeContext->context[$activeProperty][Keyword::CONTEXT->value];
        // }

        // 4
        if (\is_scalar($element)) {
            // 4.1
            if (\in_array($activeProperty, [null, Keyword::GRAPH->value], true)) {
                return null;
            }

            // 4.2
            if (isset($propertyScopedContext)) {
                $activeContext = $this->contextProcesser->processContext(
                    $activeContext,
                    $propertyScopedContext,
                    $activeContext->options->termDefinitions[$activeProperty]->baseUrl
                );
            }

            // 4.3
            // Value Expansion Algorithm : skipping for now.
        }

        // 5
        if (is_array($element)) {
            // 5.1
            $result = [];

            // 5.2
            foreach ($element as $item) {
                $expandedItem = $this->process(
                    $item,
                    $options,
                    $baseUrl,
                    $activeContext,
                    $activeProperty,
                );

                if (in_array(
                    Keyword::LIST->value,
                    $activeContext->options->termDefinitions[$activeProperty]->containerMapping
                )) {
                    if (is_array($expandedItem)) {
                        $expandedItem = [Keyword::LIST->value => $expandedItem];
                    }
                }

                if (is_array($expandedItem)) {
                    $result = [...$result, ...$expandedItem];
                } elseif (null !== $expandedItem) {
                    $result[] = $expandedItem;
                }

                // 5.3
                return $result;
            }
        }

        // 6: do nothing

        return json_encode((array) $element);
    }
}
