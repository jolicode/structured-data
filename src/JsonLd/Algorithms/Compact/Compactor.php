<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Compact;

use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\DocumentLoader;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\TermDefinition\TermDefinition;

class Compactor
{
    private IriCompactor $iriCompactor;

    public function __construct(
        private readonly ContextProcesser $contextProcesser = new ContextProcesser(),
        private readonly Expander $expander = new Expander(),
    ) {
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

            $documentLoader = new DocumentLoader($baseUrl);
            $element = $documentLoader->load();
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
        $activeContext = $this->contextProcesser->processContext(new Context(
            baseIri: $options->compactToRelative ? $baseUrl : null,
            baseUrl: $baseUrl,
            processingMode: $options->processingMode,
        ), $context, $baseUrl);

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
            $activePropertyDefinition = $this->getTermDefinition($activeContext, $activeProperty);

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
            && !$this->isSubjectReference($element)
        ) {
            $activeContext = $activeContext->previousContext;
        }

        // 6
        $inputPropertyDefinition = $this->getTermDefinition($inputContext, $activeProperty);

        if ($inputPropertyDefinition && false !== $inputPropertyDefinition->context && null !== $inputPropertyDefinition->context) {
            $activeContext = $this->contextProcesser->processContext(
                $activeContext,
                $inputPropertyDefinition->context,
                $inputPropertyDefinition->baseUrl,
                overrideProtected: true,
            );
        }

        $activePropertyDefinition = $this->getTermDefinition($activeContext, $activeProperty);

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
                $termDefinition = $this->getTermDefinition($typeScopedContext, $term);

                // 11.3
                if ($termDefinition && false !== $termDefinition->context && null !== $termDefinition->context) {
                    $activeContext = $this->contextProcesser->processContext(
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
                $aliasDefinition = $this->getTermDefinition($activeContext, $alias);
                $asArray = (
                    Context::PROCESSING_MODE_10 !== $activeContext->processingMode
                    && \in_array(Keyword::SET->value, $aliasDefinition->containerMapping ?? [], true)
                ) || !$compactArrays;

                // 12.2.5
                self::addValue($result, $alias, $compactedValue, $asArray);

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
                    $propertyDefinition = $this->getTermDefinition($activeContext, $property);

                    // 12.3.2.1
                    if ($propertyDefinition?->reverseProperty) {
                        // 12.3.2.1.1
                        $asArray = \in_array(Keyword::SET->value, $propertyDefinition->containerMapping ?? [], true) || !$compactArrays;

                        // 12.3.2.1.2
                        self::addValue($result, $property, $value, $asArray);

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
                self::addValue($nestResult, $itemActiveProperty, [], true);
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
                $itemActivePropertyDefinition = $this->getTermDefinition($activeContext, $itemActiveProperty);
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
                        self::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
                    } else {
                        // 12.8.6.3
                        $nestResult->{$itemActiveProperty} = $compactedItem;
                    }

                    continue;
                }

                // 12.8.7
                if (IriCompactor::isGraphObject($expandedItem)) {
                    $this->compactGraphItem($activeContext, $nestResult, $itemActiveProperty, $container, $expandedItem, $compactedItem, $asArray, $compactArrays);

                    continue;
                }

                // 12.8.8
                $mapContainerKeyword = $this->getMapContainerKeyword($container);

                if (null !== $mapContainerKeyword && !\in_array(Keyword::GRAPH->value, $container, true)) {
                    $this->compactMapItem($activeContext, $nestResult, $itemActiveProperty, $mapContainerKeyword, $itemActivePropertyDefinition, $expandedItem, $compactedItem, $asArray);

                    continue;
                }

                // 12.8.9
                self::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
            }
        }

        // 13
        return $result;
    }

    /**
     * Step 12.8.7 of the Compaction algorithm: compacting an expanded item that is
     * a graph object.
     *
     * @param array<string> $container
     */
    private function compactGraphItem(
        Context $activeContext,
        \stdClass $nestResult,
        string $itemActiveProperty,
        array $container,
        \stdClass $expandedItem,
        mixed $compactedItem,
        bool $asArray,
        bool $compactArrays,
    ): void {
        $containsGraph = \in_array(Keyword::GRAPH->value, $container, true);

        // 12.8.7.1
        if ($containsGraph && \in_array(Keyword::ID->value, $container, true)) {
            // 12.8.7.1.1
            $mapObject = $this->resolveMapObject($nestResult, $itemActiveProperty);

            // 12.8.7.1.2
            $mapKey = property_exists($expandedItem, Keyword::ID->value)
                ? (string) $this->iriCompactor->compactIri($activeContext, $expandedItem->{Keyword::ID->value})
                : (string) $this->iriCompactor->compactIri($activeContext, Keyword::NONE->value, vocab: true);

            // 12.8.7.1.3
            self::addValue($mapObject, $mapKey, $compactedItem, $asArray);

            return;
        }

        // 12.8.7.2
        if ($containsGraph && \in_array(Keyword::INDEX->value, $container, true) && IriCompactor::isSimpleGraphObject($expandedItem)) {
            // 12.8.7.2.1
            $mapObject = $this->resolveMapObject($nestResult, $itemActiveProperty);

            // 12.8.7.2.2
            $mapKey = property_exists($expandedItem, Keyword::INDEX->value)
                ? $expandedItem->{Keyword::INDEX->value}
                : Keyword::NONE->value;

            // 12.8.7.2.3
            self::addValue($mapObject, $mapKey, $compactedItem, $asArray);

            return;
        }

        // 12.8.7.3
        if ($containsGraph && IriCompactor::isSimpleGraphObject($expandedItem)) {
            // 12.8.7.3.1
            if (\is_array($compactedItem) && \count($compactedItem) > 1) {
                $includedObject = new \stdClass();
                $includedObject->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::INCLUDED->value, vocab: true)} = $compactedItem;
                $compactedItem = $includedObject;
            }

            // 12.8.7.3.2
            self::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);

            return;
        }

        // 12.8.7.4
        // 12.8.7.4.1
        // A single-item array collapses before wrapping, so that the wrapped graph
        // reads as one value.
        if (\is_array($compactedItem) && 1 === \count($compactedItem) && $compactArrays) {
            $compactedItem = $compactedItem[0];
        }

        $graphObject = new \stdClass();
        $graphObject->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::GRAPH->value, vocab: true)} = $compactedItem;
        $compactedItem = $graphObject;

        // 12.8.7.4.2
        if (property_exists($expandedItem, Keyword::ID->value)) {
            $compactedItem->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::ID->value, vocab: true)} = $this->iriCompactor->compactIri($activeContext, $expandedItem->{Keyword::ID->value});
        }

        // 12.8.7.4.3
        if (property_exists($expandedItem, Keyword::INDEX->value)) {
            $compactedItem->{(string) $this->iriCompactor->compactIri($activeContext, Keyword::INDEX->value, vocab: true)} = $expandedItem->{Keyword::INDEX->value};
        }

        // 12.8.7.4.4
        self::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
    }

    /**
     * Step 12.8.8 of the Compaction algorithm: filing the compacted item into a
     * language, index, id or type map.
     */
    private function compactMapItem(
        Context $activeContext,
        \stdClass $nestResult,
        string $itemActiveProperty,
        string $mapContainerKeyword,
        ?TermDefinition $itemActivePropertyDefinition,
        \stdClass $expandedItem,
        mixed $compactedItem,
        bool $asArray,
    ): void {
        // 12.8.8.1
        $mapObject = $this->resolveMapObject($nestResult, $itemActiveProperty);

        // 12.8.8.2
        $containerKey = (string) $this->iriCompactor->compactIri($activeContext, $mapContainerKeyword, vocab: true);

        // 12.8.8.3
        $indexKey = $itemActivePropertyDefinition->indexMapping ?? Keyword::INDEX->value;
        $mapKey = null;

        if (Keyword::LANGUAGE->value === $mapContainerKeyword && property_exists($expandedItem, Keyword::VALUE->value)) {
            // 12.8.8.4
            $compactedItem = $expandedItem->{Keyword::VALUE->value};

            if (property_exists($expandedItem, Keyword::LANGUAGE->value)) {
                $mapKey = $expandedItem->{Keyword::LANGUAGE->value};
            }
        } elseif (Keyword::INDEX->value === $mapContainerKeyword && Keyword::INDEX->value === $indexKey) {
            // 12.8.8.5
            if (property_exists($expandedItem, Keyword::INDEX->value)) {
                $mapKey = $expandedItem->{Keyword::INDEX->value};
            }
        } elseif (Keyword::INDEX->value === $mapContainerKeyword && Keyword::INDEX->value !== $indexKey) {
            // 12.8.8.6
            // 12.8.8.6.1
            // The index property is looked up in the compacted item under the index
            // key as authored in the term definition (the usual form the property
            // compacted to), falling back to IRI compacting its expanded form (when
            // the term definition authored a full IRI).
            $containerKey = $indexKey;

            if ($compactedItem instanceof \stdClass && !property_exists($compactedItem, $containerKey)) {
                $containerKey = (string) $this->iriCompactor->compactIri(
                    $activeContext,
                    IriResolver::expand($activeContext, $indexKey),
                    vocab: true,
                );
            }

            // 12.8.8.6.2
            if ($compactedItem instanceof \stdClass && property_exists($compactedItem, $containerKey)) {
                $containerValue = $compactedItem->{$containerKey};
                $containerValues = \is_array($containerValue) ? $containerValue : [$containerValue];
                $mapKey = array_shift($containerValues);

                if (!\is_string($mapKey)) {
                    // A non-string index value cannot be used as a map key: the item
                    // is filed under @none and keeps its index entry untouched.
                    $mapKey = null;
                } elseif ([] === $containerValues) {
                    // 12.8.8.6.3
                    unset($compactedItem->{$containerKey});
                } elseif (1 === \count($containerValues)) {
                    $compactedItem->{$containerKey} = $containerValues[0];
                } else {
                    $compactedItem->{$containerKey} = $containerValues;
                }
            }
        } elseif (Keyword::ID->value === $mapContainerKeyword) {
            // 12.8.8.7
            if ($compactedItem instanceof \stdClass && property_exists($compactedItem, $containerKey)) {
                $mapKey = $compactedItem->{$containerKey};
                unset($compactedItem->{$containerKey});
            }
        } elseif (Keyword::TYPE->value === $mapContainerKeyword) {
            // 12.8.8.8
            // 12.8.8.8.1
            $types = $compactedItem instanceof \stdClass && property_exists($compactedItem, $containerKey)
                ? (array) $compactedItem->{$containerKey}
                : [];
            $mapKey = array_shift($types);

            if ($compactedItem instanceof \stdClass) {
                // 12.8.8.8.2
                if ([] === $types) {
                    unset($compactedItem->{$containerKey});
                } elseif (1 === \count($types)) {
                    $compactedItem->{$containerKey} = $types[0];
                } else {
                    $compactedItem->{$containerKey} = $types;
                }

                // 12.8.8.8.3
                if (
                    1 === \count(get_object_vars($compactedItem))
                    && property_exists($expandedItem, Keyword::ID->value)
                ) {
                    $idOnlyItem = new \stdClass();
                    $idOnlyItem->{Keyword::ID->value} = $expandedItem->{Keyword::ID->value};
                    $compactedItem = $this->doCompact($activeContext, $itemActiveProperty, $idOnlyItem);
                }
            }
        }

        // 12.8.8.9
        if (null === $mapKey) {
            $mapKey = (string) $this->iriCompactor->compactIri($activeContext, Keyword::NONE->value, vocab: true);
        }

        // 12.8.8.10
        self::addValue($mapObject, $mapKey, $compactedItem, $asArray);
    }

    /**
     * Steps 12.7.2, 12.7.3 and 12.8.2 of the Compaction algorithm: when the term
     * definition of the item active property declares a nest value, the compacted
     * entry goes into the nested map instead of the result itself.
     */
    private function resolveNestResult(Context $activeContext, \stdClass $result, string $itemActiveProperty): \stdClass
    {
        $definition = $this->getTermDefinition($activeContext, $itemActiveProperty);

        if (null === $definition?->nestValue) {
            return $result;
        }

        $nestTerm = $definition->nestValue;

        // The nest term must expand to @nest.
        if (Keyword::NEST->value !== $nestTerm) {
            $nestTermDefinition = $this->getTermDefinition($activeContext, $nestTerm);

            if (Keyword::NEST->value !== $nestTermDefinition?->iriMapping) {
                throw new JsonLdException('invalid @nest value');
            }
        }

        if (!property_exists($result, $nestTerm)) {
            $result->{$nestTerm} = new \stdClass();
        }

        return $result->{$nestTerm};
    }

    private function resolveMapObject(\stdClass $nestResult, string $itemActiveProperty): \stdClass
    {
        if (!property_exists($nestResult, $itemActiveProperty) || !$nestResult->{$itemActiveProperty} instanceof \stdClass) {
            $nestResult->{$itemActiveProperty} = new \stdClass();
        }

        return $nestResult->{$itemActiveProperty};
    }

    /**
     * @param array<string> $container
     */
    private function getMapContainerKeyword(array $container): ?string
    {
        foreach ([Keyword::LANGUAGE->value, Keyword::INDEX->value, Keyword::ID->value, Keyword::TYPE->value] as $keyword) {
            if (\in_array($keyword, $container, true)) {
                return $keyword;
            }
        }

        return null;
    }

    private function getTermDefinition(Context $activeContext, ?string $term): ?TermDefinition
    {
        if (null === $term) {
            return null;
        }

        $definition = $activeContext->termDefinitions[$term] ?? null;

        return $definition instanceof TermDefinition ? $definition : null;
    }

    private function isSubjectReference(\stdClass $element): bool
    {
        $entries = get_object_vars($element);

        return 1 === \count($entries) && \array_key_exists(Keyword::ID->value, $entries);
    }

    /**
     * The Add Value macro from the JSON-LD 1.1 Processing Algorithms and API W3C
     * Recommendation, with the exact semantics compaction relies on (an existing
     * scalar entry is wrapped into an array before appending).
     *
     * @see https://www.w3.org/TR/json-ld-api/#dfn-add-value
     */
    private static function addValue(\stdClass $object, string $key, mixed $value, bool $asArray = false): void
    {
        // 1
        if ($asArray && !property_exists($object, $key)) {
            $object->{$key} = [];
        }

        // 2
        if (\is_array($value)) {
            foreach ($value as $item) {
                self::addValue($object, $key, $item);
            }

            return;
        }

        // 3
        if (!property_exists($object, $key)) {
            $object->{$key} = $asArray ? [$value] : $value;

            return;
        }

        if (!\is_array($object->{$key})) {
            $object->{$key} = [$object->{$key}];
        }

        $object->{$key}[] = $value;
    }
}
