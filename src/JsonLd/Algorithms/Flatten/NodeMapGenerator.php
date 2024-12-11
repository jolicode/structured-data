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

use Jolicode\JsonLd\Algorithms\Exception\FlatteningException;
use Jolicode\JsonLd\Algorithms\JsonLd\FramingKeyword;
use Jolicode\JsonLd\Algorithms\Services\DataStructureComparator;
use Jolicode\JsonLd\Algorithms\Services\IdentifierGenerator;

class NodeMapGenerator
{
    public function __construct(
        private IdentifierGenerator $identifierGenerator,
    ) {
    }

    /**
     * Implementation of the Node Map Generation algorithm : https://www.w3.org/TR/json-ld11-api/#algorithm-10
     * It is based on the 16th July 2020 recommendation.
     */
    public function buildNode(
        mixed $element,
        array &$nodeMap,
        string $activeGraph = FramingKeyword::DEFAULT->value,
        mixed $activeSubject = null,
        ?string $activeProperty = null,
        ?array &$list = null,
    ): void {
        // 1
        if (\is_array($element)) {
            foreach ($element as $item) {
                // 1.1
                $this->buildNode($item, $nodeMap, $activeGraph, $activeSubject, $activeProperty, $list);
            }

            return;
        }

        // 2
        $graph = &$nodeMap[$activeGraph];

        // 2
        if (null === $activeSubject) {
            $subjectNode = null;
        } elseif (\is_object($activeSubject)) {
            $subjectNode = [FramingKeyword::ID->value => $activeSubject];
        } else {
            $subjectNode = &$graph[$activeSubject];
        }

        // 3
        if (property_exists($element, FramingKeyword::TYPE->value)) {
            // 3.1
            if (\is_array($element->{FramingKeyword::TYPE->value}) || \is_object($element->{FramingKeyword::TYPE->value})) {
                foreach ($element->{FramingKeyword::TYPE->value} as &$item) {
                    $item = $this->identifierGenerator->getIdentifier($item);
                }
            } else {
                $element->{FramingKeyword::TYPE->value} = $this->identifierGenerator->getIdentifier($element->{FramingKeyword::TYPE->value});
            }
        }

        // 4
        if (property_exists($element, FramingKeyword::VALUE->value)) {
            // 4.1
            if (null === $list) {
                if (null === $subjectNode || !\array_key_exists($activeProperty, $subjectNode)) {
                    $subjectNode[$activeProperty] = [$element];
                // 4.1.2
                } else {
                    if (!DataStructureComparator::objectAlreadyInArray($element, $subjectNode[$activeProperty])) {
                        $subjectNode[$activeProperty][] = $element;
                    }
                }
            // 4.2
            } else {
                $list[FramingKeyword::LIST->value][] = $element;
            }
        // 5
        } elseif (property_exists($element, FramingKeyword::LIST->value)) {
            // 5.1
            $result = [FramingKeyword::LIST->value => []];

            // 5.2
            $this->buildNode($element->{FramingKeyword::LIST->value}, $nodeMap, $activeGraph, $activeSubject, $activeProperty, $result);

            if (\is_object($result[FramingKeyword::LIST->value])) {
                $result[FramingKeyword::LIST->value] = [$result[FramingKeyword::LIST->value]];
            }

            // 5.3
            if (null === $list) {
                $subjectNode[$activeProperty][] = $result;
            // 5.4
            } else {
                $list[FramingKeyword::LIST->value][] = $result;
            }
        // 6
        } else {
            if (null === $graph) {
                $graph = [];
            }

            // 6.1
            if (property_exists($element, FramingKeyword::ID->value)) {
                $id = $this->identifierGenerator->getIdentifier($element->{FramingKeyword::ID->value});
                unset($element->{FramingKeyword::ID->value});
            // 6.2
            } else {
                $id = $this->identifierGenerator->getIdentifier(null);
            }

            // 6.3
            if (!\array_key_exists($id, $graph)) {
                $graph[$id] = [FramingKeyword::ID->value => $id];
            }

            // 6.4
            $node = &$graph[$id];

            // 6.5
            if (\is_object($activeSubject)) {
                // 6.5.1
                if (!\array_key_exists($activeProperty, $node)) {
                    $node[$activeProperty] = [$activeSubject];
                // 6.5.2
                } elseif (!DataStructureComparator::objectAlreadyInArray($activeSubject, $node[$activeProperty])) {
                    $node[$activeProperty][] = $activeSubject;
                }
            // 6.6
            } elseif (null !== $activeProperty) {
                // 6.6.1
                $reference = (object) [FramingKeyword::ID->value => $id];

                // 6.6.2
                if (null === $list) {
                    if (null === $subjectNode) {
                        $subjectNode = [];
                    }

                    // 6.6.2.1
                    if (!\array_key_exists($activeProperty, $subjectNode)) {
                        $subjectNode[$activeProperty] = [$reference];
                    // 6.6.2.2
                    } elseif (!DataStructureComparator::objectAlreadyInArray($reference, $subjectNode[$activeProperty])) {
                        $subjectNode[$activeProperty][] = $reference;
                    }
                // 6.6.3
                } else {
                    $list[FramingKeyword::LIST->value][] = $reference;
                }
            }

            // 6.7
            if (property_exists($element, FramingKeyword::TYPE->value)) {
                foreach ((array) $element->{FramingKeyword::TYPE->value} as $type) {
                    if (!\array_key_exists(FramingKeyword::TYPE->value, $node)) {
                        $node[FramingKeyword::TYPE->value] = [];
                    }

                    if (!\in_array($type, $node[FramingKeyword::TYPE->value], true)) {
                        $node[FramingKeyword::TYPE->value][] = $type;
                    }
                }

                unset($element->{FramingKeyword::TYPE->value});
            }

            // 6.8
            if (property_exists($element, FramingKeyword::INDEX->value)) {
                if (\array_key_exists(FramingKeyword::INDEX->value, $node) && $node[FramingKeyword::INDEX->value] !== $element->{FramingKeyword::INDEX->value}) {
                    throw new FlatteningException('Conflicting Index Exception : aborting processing');
                }

                $node[FramingKeyword::INDEX->value] = $element->{FramingKeyword::INDEX->value};
                unset($element->{FramingKeyword::INDEX->value});
            }

            // 6.9
            if (property_exists($element, FramingKeyword::REVERSE->value)) {
                // 6.9.1
                $referencedNode = (object) [FramingKeyword::ID->value => $id];
                // 6.9.2
                $reverseMap = $element->{FramingKeyword::REVERSE->value};

                // 6.9.3
                foreach ($reverseMap as $property => $values) {
                    // 6.9.3.1
                    foreach ($values as $value) {
                        // 6.9.3.1.1
                        $this->buildNode($value, $nodeMap, $activeGraph, $referencedNode, $property);
                    }
                }

                // 6.9.3.4
                unset($element->{FramingKeyword::REVERSE->value});
            }

            // 6.10
            if (property_exists($element, FramingKeyword::GRAPH->value)) {
                $this->buildNode($element->{FramingKeyword::GRAPH->value}, $nodeMap, $id);
                unset($element->{FramingKeyword::GRAPH->value});
            }

            // 6.11
            if (property_exists($element, FramingKeyword::INCLUDED->value)) {
                $this->buildNode($element->{FramingKeyword::INCLUDED->value}, $nodeMap, $activeGraph);
                unset($element->{FramingKeyword::INCLUDED->value});
            }

            $sortedElementProperties = (array) $element;
            ksort($sortedElementProperties);

            // 6.12
            foreach ($sortedElementProperties as $property => $value) {
                // 6.12.1
                $property = $this->identifierGenerator->getIdentifier($property);

                // 6.12.2
                if (!\array_key_exists($property, $node)) {
                    $node[$property] = [];
                }

                // 6.12.3
                $this->buildNode($value, $nodeMap, $activeGraph, $id, $property);
            }
        }
    }
}
