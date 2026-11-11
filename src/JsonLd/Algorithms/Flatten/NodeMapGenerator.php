<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Flatten;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\FlatteningException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\DataStructureComparator;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\IdentifierGenerator;

/**
 * @phpstan-type Node array<string, mixed>
 * @phpstan-type Graph array<string, Node>
 * @phpstan-type NodeMap array<string, Graph|null>
 */
class NodeMapGenerator
{
    public function __construct(
        private IdentifierGenerator $identifierGenerator,
    ) {
    }

    /**
     * This is a PHP implementation of the Node Map Generation algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld11-api/#algorithm-10
     *
     * @param NodeMap                          $nodeMap
     * @param array{'@list': list<mixed>}|null $list
     */
    public function buildNode(
        mixed $element,
        array &$nodeMap,
        string $activeGraph = FramingKeyword::DEFAULT->value,
        string|\stdClass|null $activeSubject = null,
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

        if (!$element instanceof \stdClass) {
            throw new FlatteningException('A node map element must be a map.');
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
            $types = $element->{FramingKeyword::TYPE->value};

            // 3.1
            if (\is_array($types) || \is_object($types)) {
                $identifiers = [];

                foreach ((array) $types as $key => $type) {
                    $identifiers[$key] = $this->identifier($type);
                }

                $element->{FramingKeyword::TYPE->value} = $identifiers;
            } else {
                $element->{FramingKeyword::TYPE->value} = $this->identifier($types);
            }
        }

        // 4
        if (property_exists($element, FramingKeyword::VALUE->value)) {
            // 4.1
            if (null !== $activeProperty && null === $list) {
                if (null === $subjectNode || !\array_key_exists($activeProperty, $subjectNode)) {
                    $subjectNode[$activeProperty] = [$element];
                // 4.1.2
                } else {
                    $values = self::propertyValues($subjectNode, $activeProperty);

                    if (!DataStructureComparator::objectAlreadyInArray($element, $values)) {
                        $values[] = $element;
                        $subjectNode[$activeProperty] = $values;
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

            if (null === $result) {
                throw new FlatteningException('The result must have a LIST key');
            }

            // 5.3
            if (null === $list) {
                if (null === $activeProperty) {
                    throw new FlatteningException('Invalid active property.');
                }

                $values = self::propertyValues($subjectNode ?? [], $activeProperty);
                $values[] = $result;
                $subjectNode[$activeProperty] = $values;
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
                $id = $this->identifier($element->{FramingKeyword::ID->value});
                unset($element->{FramingKeyword::ID->value});
            // 6.2
            } else {
                $id = $this->identifier(null);
            }

            // 6.3
            if (!\array_key_exists($id, $graph)) {
                $graph[$id] = [FramingKeyword::ID->value => $id];
            }

            // 6.4
            $node = &$graph[$id];

            // 6.5
            if (null !== $activeProperty) {
                if ($activeSubject instanceof \stdClass) {
                    // 6.5.1
                    if (!\array_key_exists($activeProperty, $node)) {
                        $node[$activeProperty] = [$activeSubject];
                    // 6.5.2
                    } else {
                        $values = self::propertyValues($node, $activeProperty);

                        if (!DataStructureComparator::objectAlreadyInArray($activeSubject, $values)) {
                            $values[] = $activeSubject;
                            $node[$activeProperty] = $values;
                        }
                    }
                // 6.6
                } else {
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
                        } else {
                            $values = self::propertyValues($subjectNode, $activeProperty);

                            if (!DataStructureComparator::objectAlreadyInArray($reference, $values)) {
                                $values[] = $reference;
                                $subjectNode[$activeProperty] = $values;
                            }
                        }
                    // 6.6.3
                    } else {
                        $list[FramingKeyword::LIST->value][] = $reference;
                    }
                }
            }

            // 6.7
            if (property_exists($element, FramingKeyword::TYPE->value)) {
                foreach ((array) $element->{FramingKeyword::TYPE->value} as $type) {
                    $types = self::propertyValues($node, FramingKeyword::TYPE->value);

                    if (!\in_array($type, $types, true)) {
                        $types[] = $type;
                    }

                    $node[FramingKeyword::TYPE->value] = $types;
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

                if (!$reverseMap instanceof \stdClass) {
                    throw new FlatteningException('The @reverse value must be a map.');
                }

                // 6.9.3
                foreach (get_object_vars($reverseMap) as $property => $values) {
                    // 6.9.3.1
                    foreach ((array) $values as $value) {
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
                $property = $this->identifier((string) $property);

                // 6.12.2
                if (!\array_key_exists($property, $node)) {
                    $node[$property] = [];
                }

                // 6.12.3
                $this->buildNode($value, $nodeMap, $activeGraph, $id, $property);
            }
        }
    }

    /**
     * Blank node identifiers are replaced by a generated identifier, any other
     * identifier is kept as is.
     */
    private function identifier(mixed $value): string
    {
        if (null !== $value && !\is_string($value)) {
            throw new FlatteningException('The identifier must be a string');
        }

        return $this->identifierGenerator->getIdentifier($value);
    }

    /**
     * @param Node $node
     *
     * @return list<mixed>
     */
    private static function propertyValues(array $node, string $property): array
    {
        $values = $node[$property] ?? [];

        if (!\is_array($values)) {
            throw new FlatteningException(\sprintf('The values of the "%s" property must be an array.', $property));
        }

        return array_values($values);
    }
}
