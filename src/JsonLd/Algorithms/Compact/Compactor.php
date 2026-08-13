<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Compact;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextCache;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

class Compactor
{
    private IriCompactor $iriCompactor;

    private readonly ContextProcessor $contextProcessor;
    private readonly Expander $expander;
    private readonly DocumentLoaderInterface $documentLoader;

    public function __construct(
        ?ContextProcessor $contextProcessor = null,
        ?Expander $expander = null,
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $this->documentLoader = $documentLoader ?? new HttpDocumentLoader();
        $this->contextProcessor = $contextProcessor ?? new ContextProcessor(new ContextCache($this->documentLoader));
        $this->expander = $expander ?? new Expander(documentLoader: $this->documentLoader);
        $this->iriCompactor = new IriCompactor();
    }

    /**
     * Compacts a JSON-LD document against the provided context.
     *
     * This is a PHP implementation of the compact() method of the JsonLdProcessor
     * interface described in the JSON-LD 1.1 Processing Algorithms and API W3C
     * Recommendation published on July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#dom-jsonldprocessor-compact
     */
    public function compact(
        string|\stdClass $json,
        mixed $context = null,
        ProcessorOptions $options = new ProcessorOptions(),
        bool $encodeResult = true,
        bool $skipExpansion = false,
        bool $forceGraph = false,
    ): \stdClass|array|string|false|null {
        $element = \is_string($json) ? json_decode($json) : $json;
        $baseUrl = $options->base;

        if (null === $element) {
            throw new JsonLdException('The JSON string could not be parsed.');
        }

        if (\is_string($element)) {
            $baseUrl = $element;

            $element = $this->documentLoader->load($baseUrl);
        }

        // 4
        if ($skipExpansion) {
            // The caller guarantees the input is already in expanded form (e.g. the
            // output of the framing algorithm, which must not be re-expanded because
            // expansion would drop its free-floating pruned nodes).
            $expandedInput = $element;
        } else {
            // The expander entry point accepts maps only; a top-level array (which is
            // valid JSON-LD) goes through its JSON representation.
            if (\is_array($element)) {
                $element = (string) json_encode($element);
            }

            $expandedInput = $this->expander->expand($element, new ProcessorOptions(
                base: $baseUrl,
                expandContext: $options->expandContext,
                processingMode: $options->processingMode,
                ordered: $options->ordered,
            ), encodeResult: false);
        }

        if (\is_string($context)) {
            $decodedContext = json_decode($context);
            $context = null === $decodedContext && 'null' !== trim($context) ? $context : $decodedContext;
        }

        // 5
        if ($context instanceof \stdClass && property_exists($context, Keyword::CONTEXT->value)) {
            $context = $context->{Keyword::CONTEXT->value};
        }

        // 6
        // 7
        $activeContext = $this->contextProcessor->processContext(new Context(
            baseIri: $options->compactToRelative ? $baseUrl : null,
            baseUrl: $baseUrl,
            processingMode: $options->processingMode,
        ), $context, $baseUrl);

        // The IRI compactor carries the caller options, so it is rebuilt here rather
        // than being readonly. Collaborators must receive it as an argument: holding
        // on to the constructor instance would ignore the options given to compact().
        $this->iriCompactor = new IriCompactor($options);

        // 8
        $compacted = $this->doCompact($activeContext, null, $expandedInput, $options->compactArrays, $options->ordered);

        if ($forceGraph) {
            // Framing with omitGraph false: the result always lives in a @graph
            // entry, even when there is a single top-level node or none at all.
            if (!\is_array($compacted)) {
                $compacted = [] === get_object_vars((object) $compacted) ? [] : [$compacted];
            }

            $compacted = (object) [
                (string) $this->iriCompactor->compactIri($activeContext, Keyword::GRAPH->value, vocab: true) => $compacted,
            ];
        } elseif (\is_array($compacted)) {
            $compacted = [] === $compacted
                ? new \stdClass()
                : (object) [
                    (string) $this->iriCompactor->compactIri($activeContext, Keyword::GRAPH->value, vocab: true) => $compacted,
                ];
        }

        if (!$compacted instanceof \stdClass) {
            $wrapped = new \stdClass();

            if (null !== $compacted) {
                $wrapped->{Keyword::GRAPH->value} = $compacted;
            }

            $compacted = $wrapped;
        }

        if (null !== $context && (!\is_array($context) || [] !== $context) && (!$context instanceof \stdClass || [] !== get_object_vars($context))) {
            $withContext = new \stdClass();
            $withContext->{Keyword::CONTEXT->value} = $context;

            foreach (get_object_vars($compacted) as $key => $value) {
                $withContext->{$key} = $value;
            }

            $compacted = $withContext;
        }

        if ($encodeResult) {
            return json_encode($compacted, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
        }

        return $compacted;
    }

    /**
     * Takes an expanded JSON-LD element and compacts it using the provided context.
     *
     * This is a PHP implementation of the Compaction algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#compaction-algorithm
     */
    public function doCompact(
        Context $activeContext,
        ?string $activeProperty,
        mixed $element,
        bool $compactArrays = true,
        bool $ordered = false,
    ): mixed {
        // 1
        $typeScopedContext = $activeContext;

        // 2
        if (null === $element || \is_scalar($element)) {
            return $element;
        }

        // 3
        if (\is_array($element)) {
            // 3.1
            $result = [];

            // 3.2
            foreach ($element as $item) {
                // 3.2.1
                $compactedItem = $this->doCompact($activeContext, $activeProperty, $item, $compactArrays, $ordered);

                // 3.2.2
                if (null !== $compactedItem) {
                    $result[] = $compactedItem;
                }
            }

            // 3.3
            $activePropertyDefinition = TermLookup::getTermDefinition($activeContext, $activeProperty);

            if (
                1 === \count($result)
                && !$activePropertyDefinition?->containerMapping
                && $compactArrays
            ) {
                return $result[0];
            }

            // 3.4
            return $result;
        }

        // 4: element is a map.
        // The property-scoped context of the active property is looked up in the
        // context as received (which may be type-scoped), while the revert below
        // restores the context that was active before any type-scoped context.
        $inputContext = $activeContext;

        // 5
        if (
            null !== $activeContext->previousContext
            && !property_exists($element, Keyword::VALUE->value)
            && !TermLookup::isSubjectReference($element)
        ) {
            $activeContext = $activeContext->previousContext;
        }

        // 6
        $inputPropertyDefinition = TermLookup::getTermDefinition($inputContext, $activeProperty);

        if ($inputPropertyDefinition && false !== $inputPropertyDefinition->context && null !== $inputPropertyDefinition->context) {
            $activeContext = $this->contextProcessor->processContext(
                $activeContext,
                $inputPropertyDefinition->context,
                $inputPropertyDefinition->baseUrl,
                overrideProtected: true,
            );
        }

        $activePropertyDefinition = TermLookup::getTermDefinition($activeContext, $activeProperty);

        // 7
        if (property_exists($element, Keyword::VALUE->value) || property_exists($element, Keyword::ID->value)) {
            $compactedValue = $this->iriCompactor->compactValue($activeContext, $activeProperty, $element);

            if (\is_scalar($compactedValue) || Keyword::JSON->value === $activePropertyDefinition?->typeMapping) {
                return $compactedValue;
            }
        }

        // 8
        if (
            IriCompactor::isListObject($element)
            && \in_array(Keyword::LIST->value, $activePropertyDefinition->containerMapping ?? [], true)
        ) {
            return $this->doCompact($activeContext, $activeProperty, $element->{Keyword::LIST->value}, $compactArrays, $ordered);
        }

        // 9
        $insideReverse = Keyword::REVERSE->value === $activeProperty;

        // 10
        $result = new \stdClass();

        // 11
        if (property_exists($element, Keyword::TYPE->value)) {
            // 11.1
            $compactedTypes = [];

            foreach ((array) $element->{Keyword::TYPE->value} as $type) {
                $compactedTypes[] = (string) $this->iriCompactor->compactIri($typeScopedContext, $type, vocab: true);
            }

            // 11.2
            sort($compactedTypes);

            foreach ($compactedTypes as $term) {
                $termDefinition = TermLookup::getTermDefinition($typeScopedContext, $term);

                // 11.3
                if ($termDefinition && false !== $termDefinition->context && null !== $termDefinition->context) {
                    $activeContext = $this->contextProcessor->processContext(
                        $activeContext,
                        $termDefinition->context,
                        $termDefinition->baseUrl,
                        propagate: false,
                    );
                }
            }
        }

        // 12
        $entries = get_object_vars($element);

        if ($ordered) {
            ksort($entries);
        }

        foreach ($entries as $expandedProperty => $expandedValue) {
            // 12.1
            if (Keyword::ID->value === $expandedProperty) {
                $compactedValue = null;

                // 12.1.1
                if (\is_string($expandedValue)) {
                    $compactedValue = $this->iriCompactor->compactIri($activeContext, $expandedValue);
                }

                // 12.1.2
                $alias = (string) $this->iriCompactor->compactIri($activeContext, $expandedProperty, vocab: true);

                // 12.1.3
                $result->{$alias} = $compactedValue;

                continue;
            }

            // 12.2
            if (Keyword::TYPE->value === $expandedProperty) {
                // 12.2.1
                if (\is_string($expandedValue)) {
                    $compactedValue = $this->iriCompactor->compactIri($typeScopedContext, $expandedValue, vocab: true);
                } else {
                    // 12.2.2
                    $compactedValue = [];

                    // 12.2.2.1
                    foreach ($expandedValue as $expandedType) {
                        // 12.2.2.2
                        $compactedValue[] = (string) $this->iriCompactor->compactIri($typeScopedContext, $expandedType, vocab: true);
                    }
                }

                // 12.2.3
                $alias = (string) $this->iriCompactor->compactIri($activeContext, $expandedProperty, vocab: true);

                // 12.2.4
                $aliasDefinition = TermLookup::getTermDefinition($activeContext, $alias);
                $asArray = (
                    Context::PROCESSING_MODE_10 !== $activeContext->processingMode
                    && \in_array(Keyword::SET->value, $aliasDefinition->containerMapping ?? [], true)
                ) || !$compactArrays;

                // 12.2.5
                CompactionValueAdder::addValue($result, $alias, $compactedValue, $asArray);

                // 12.2.6
                continue;
            }

            // 12.3
            if (Keyword::REVERSE->value === $expandedProperty) {
                // 12.3.1
                /** @var \stdClass $compactedMap */
                $compactedMap = $this->doCompact($activeContext, Keyword::REVERSE->value, $expandedValue, $compactArrays, $ordered);

                // 12.3.2
                foreach (get_object_vars($compactedMap) as $property => $value) {
                    $propertyDefinition = TermLookup::getTermDefinition($activeContext, $property);

                    // 12.3.2.1
                    if ($propertyDefinition?->reverseProperty) {
                        // 12.3.2.1.1
                        $asArray = \in_array(Keyword::SET->value, $propertyDefinition->containerMapping ?? [], true) || !$compactArrays;

                        // 12.3.2.1.2
                        CompactionValueAdder::addValue($result, $property, $value, $asArray);

                        // 12.3.2.1.3
                        unset($compactedMap->{$property});
                    }
                }

                // 12.3.3
                if ([] !== get_object_vars($compactedMap)) {
                    // 12.3.3.1
                    $alias = (string) $this->iriCompactor->compactIri($activeContext, Keyword::REVERSE->value, vocab: true);

                    // 12.3.3.2
                    $result->{$alias} = $compactedMap;
                }

                // 12.3.4
                continue;
            }

            // 12.4
            if ('@preserve' === $expandedProperty) {
                // 12.4.1
                $compactedValue = $this->doCompact($activeContext, $activeProperty, $expandedValue, $compactArrays, $ordered);

                // 12.4.2
                if ([] !== $compactedValue) {
                    $result->{'@preserve'} = $compactedValue;
                }

                continue;
            }

            // 12.5
            if (
                Keyword::INDEX->value === $expandedProperty
                && \in_array(Keyword::INDEX->value, $activePropertyDefinition->containerMapping ?? [], true)
            ) {
                continue;
            }

            // 12.6
            if (\in_array($expandedProperty, [Keyword::DIRECTION->value, Keyword::INDEX->value, Keyword::LANGUAGE->value, Keyword::VALUE->value], true)) {
                // 12.6.1
                $alias = (string) $this->iriCompactor->compactIri($activeContext, $expandedProperty, vocab: true);

                // 12.6.2
                $result->{$alias} = $expandedValue;

                continue;
            }

            // 12.7
            if ([] === $expandedValue) {
                // 12.7.1
                $itemActiveProperty = (string) $this->iriCompactor->compactIri(
                    $activeContext,
                    $expandedProperty,
                    $expandedValue,
                    vocab: true,
                    reverse: $insideReverse,
                );

                // 12.7.2
                $nestResult = $this->resolveNestResult($activeContext, $result, $itemActiveProperty);

                // 12.7.4
                CompactionValueAdder::addValue($nestResult, $itemActiveProperty, [], true);
            }

            // 12.8
            foreach ((array) $expandedValue as $expandedItem) {
                // 12.8.1
                $itemActiveProperty = (string) $this->iriCompactor->compactIri(
                    $activeContext,
                    $expandedProperty,
                    $expandedItem,
                    vocab: true,
                    reverse: $insideReverse,
                );

                // 12.8.2
                $nestResult = $this->resolveNestResult($activeContext, $result, $itemActiveProperty);

                // 12.8.3
                $itemActivePropertyDefinition = TermLookup::getTermDefinition($activeContext, $itemActiveProperty);
                $container = $itemActivePropertyDefinition->containerMapping ?? [];

                // 12.8.4
                $asArray = \in_array(Keyword::SET->value, $container, true)
                    || Keyword::GRAPH->value === $itemActiveProperty
                    || Keyword::LIST->value === $itemActiveProperty
                    || !$compactArrays;

                // 12.8.5
                $itemToCompact = $expandedItem;

                if (IriCompactor::isListObject($expandedItem)) {
                    $itemToCompact = $expandedItem->{Keyword::LIST->value};
                } elseif (IriCompactor::isGraphObject($expandedItem)) {
                    $itemToCompact = $expandedItem->{Keyword::GRAPH->value};
                }

                $compactedItem = $this->doCompact($activeContext, $itemActiveProperty, $itemToCompact, $compactArrays, $ordered);

                // 12.8.6
                if (IriCompactor::isListObject($expandedItem)) {
                    // 12.8.6.1
                    if (!\is_array($compactedItem)) {
                        $compactedItem = [$compactedItem];
                    }

                    // 12.8.6.2
                    if (!\in_array(Keyword::LIST->value, $container, true)) {
                        // 12.8.6.2.1
                        $listObject = new \stdClass();
                        $listObject->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::LIST->value, vocab: true)} = $compactedItem;
                        $compactedItem = $listObject;

                        // 12.8.6.2.2
                        if (property_exists($expandedItem, Keyword::INDEX->value)) {
                            $compactedItem->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::INDEX->value, vocab: true)} = $expandedItem->{Keyword::INDEX->value};
                        }

                        // 12.8.6.2.3
                        CompactionValueAdder::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
                    } else {
                        // 12.8.6.3
                        $nestResult->{$itemActiveProperty} = $compactedItem;
                    }

                    continue;
                }

                // 12.8.7
                if (IriCompactor::isGraphObject($expandedItem)) {
                    ItemMapFiler::compactGraphItem($this->iriCompactor, $activeContext, $nestResult, $itemActiveProperty, $container, $expandedItem, $compactedItem, $asArray, $compactArrays);

                    continue;
                }

                // 12.8.8
                $mapContainerKeyword = TermLookup::getMapContainerKeyword($container);

                if (null !== $mapContainerKeyword && !\in_array(Keyword::GRAPH->value, $container, true)) {
                    ItemMapFiler::compactMapItem($this, $this->iriCompactor, $activeContext, $nestResult, $itemActiveProperty, $mapContainerKeyword, $itemActivePropertyDefinition, $expandedItem, $compactedItem, $asArray);

                    continue;
                }

                // 12.8.9
                CompactionValueAdder::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
            }
        }

        // 13
        return $result;
    }

    /**
     * Steps 12.7.2, 12.7.3 and 12.8.2 of the Compaction algorithm: when the term
     * definition of the item active property declares a nest value, the compacted
     * entry goes into the nested map instead of the result itself.
     */
    private function resolveNestResult(Context $activeContext, \stdClass $result, string $itemActiveProperty): \stdClass
    {
        $definition = TermLookup::getTermDefinition($activeContext, $itemActiveProperty);

        if (null === $definition?->nestValue) {
            return $result;
        }

        $nestTerm = $definition->nestValue;

        // The nest term must expand to @nest.
        if (Keyword::NEST->value !== $nestTerm) {
            $nestTermDefinition = TermLookup::getTermDefinition($activeContext, $nestTerm);

            if (Keyword::NEST->value !== $nestTermDefinition?->iriMapping) {
                throw new JsonLdException('invalid @nest value');
            }
        }

        if (!property_exists($result, $nestTerm)) {
            $result->{$nestTerm} = new \stdClass();
        }

        return $result->{$nestTerm};
    }
}
