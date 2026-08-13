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
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;

/**
 * Steps 12.8.7 and 12.8.8 of the Compaction algorithm: filing a compacted item
 * into a graph object or into a language, index, id or type map.
 *
 * The IriCompactor is taken as an argument rather than injected, because
 * Compactor rebuilds its own with the caller ProcessorOptions on every compact()
 * call. Holding on to one would silently ignore those options.
 */
final class ItemMapFiler
{
    /**
     * Step 12.8.7 of the Compaction algorithm: compacting an expanded item that is
     * a graph object.
     *
     * @param array<string> $container
     */
    public static function compactGraphItem(
        IriCompactor $iriCompactor,
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
            $mapObject = self::resolveMapObject($nestResult, $itemActiveProperty);

            // 12.8.7.1.2
            $mapKey = property_exists($expandedItem, Keyword::ID->value)
                ? (string) $iriCompactor->compactIri($activeContext, $expandedItem->{Keyword::ID->value})
                : (string) $iriCompactor->compactIri($activeContext, Keyword::NONE->value, vocab: true);

            // 12.8.7.1.3
            CompactionValueAdder::addValue($mapObject, $mapKey, $compactedItem, $asArray);

            return;
        }

        // 12.8.7.2
        if ($containsGraph && \in_array(Keyword::INDEX->value, $container, true) && IriCompactor::isSimpleGraphObject($expandedItem)) {
            // 12.8.7.2.1
            $mapObject = self::resolveMapObject($nestResult, $itemActiveProperty);

            // 12.8.7.2.2
            $mapKey = property_exists($expandedItem, Keyword::INDEX->value)
                ? $expandedItem->{Keyword::INDEX->value}
                : Keyword::NONE->value;

            // 12.8.7.2.3
            CompactionValueAdder::addValue($mapObject, $mapKey, $compactedItem, $asArray);

            return;
        }

        // 12.8.7.3
        if ($containsGraph && IriCompactor::isSimpleGraphObject($expandedItem)) {
            // 12.8.7.3.1
            if (\is_array($compactedItem) && \count($compactedItem) > 1) {
                $includedObject = new \stdClass();
                $includedObject->{(string) $iriCompactor->compactIri($activeContext, Keyword::INCLUDED->value, vocab: true)} = $compactedItem;
                $compactedItem = $includedObject;
            }

            // 12.8.7.3.2
            CompactionValueAdder::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);

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
        $graphObject->{(string) $iriCompactor->compactIri($activeContext, Keyword::GRAPH->value, vocab: true)} = $compactedItem;
        $compactedItem = $graphObject;

        // 12.8.7.4.2
        if (property_exists($expandedItem, Keyword::ID->value)) {
            $compactedItem->{(string) $iriCompactor->compactIri($activeContext, Keyword::ID->value, vocab: true)} = $iriCompactor->compactIri($activeContext, $expandedItem->{Keyword::ID->value});
        }

        // 12.8.7.4.3
        if (property_exists($expandedItem, Keyword::INDEX->value)) {
            $compactedItem->{(string) $iriCompactor->compactIri($activeContext, Keyword::INDEX->value, vocab: true)} = $expandedItem->{Keyword::INDEX->value};
        }

        // 12.8.7.4.4
        CompactionValueAdder::addValue($nestResult, $itemActiveProperty, $compactedItem, $asArray);
    }

    /**
     * Step 12.8.8 of the Compaction algorithm: filing the compacted item into a
     * language, index, id or type map.
     */
    public static function compactMapItem(
        Compactor $compactor,
        IriCompactor $iriCompactor,
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
        $mapObject = self::resolveMapObject($nestResult, $itemActiveProperty);

        // 12.8.8.2
        $containerKey = (string) $iriCompactor->compactIri($activeContext, $mapContainerKeyword, vocab: true);

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
                $containerKey = (string) $iriCompactor->compactIri(
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
                    $compactedItem = $compactor->doCompact($activeContext, $itemActiveProperty, $idOnlyItem);
                }
            }
        }

        // 12.8.8.9
        if (null === $mapKey) {
            $mapKey = (string) $iriCompactor->compactIri($activeContext, Keyword::NONE->value, vocab: true);
        }

        // 12.8.8.10
        CompactionValueAdder::addValue($mapObject, $mapKey, $compactedItem, $asArray);
    }

    private static function resolveMapObject(\stdClass $nestResult, string $itemActiveProperty): \stdClass
    {
        if (!property_exists($nestResult, $itemActiveProperty) || !$nestResult->{$itemActiveProperty} instanceof \stdClass) {
            $nestResult->{$itemActiveProperty} = new \stdClass();
        }

        return $nestResult->{$itemActiveProperty};
    }
}
