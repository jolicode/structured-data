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

use Jolicode\JsonLd\JsonLd\FramingKeyword;
use Jolicode\JsonLd\Services\IdentifierGenerator;

class NodeMapGenerator
{
    public function __construct(
        private IdentifierGenerator $identifierGenerator,
        private array $map = [
            FramingKeyword::DEFAULT->value => [],
        ],
    ) {
    }

    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * This is PHP implementation of https://www.w3.org/TR/json-ld11-api/#algorithm-10. It is based on the 16th July 2020 recommendation.
     * The numbers in comments represent the different steps in the documentation.
     * Because of PHP's data structures, we had to swap arrays and maps : an array in the doc is here a collection,
     * and a map in the doc is here an array.
     */
    public function buildNode(
        mixed $element,
        string $activeGraph = FramingKeyword::DEFAULT->value,
        mixed $activeSubject = null,
        string $activeProperty = null,
        array &$list = null
    ): void {
        // 1
        if ($this->isCollection($element)) {
            foreach ($element as $key => $item) {
                // 1.1
                $this->buildNode($item, $activeGraph, $activeSubject, $activeProperty, $list);
                // $this->buildNode([$key => $item], $activeGraph, $activeSubject, $activeProperty, $list);
            }
        }

        // 2
        $graph = $this->map[$activeGraph];
        // 2
        if (null !== $activeSubject) {
            $subjectNode = &$graph[$activeSubject];
        }

        // 3
        if (\array_key_exists('@type', $element)) {
            // 3.1
            if (\is_array($element['@type'])) {
                foreach ($element['@type'] as $type) {
                    $type = $this->identifierGenerator->getIdentifier($type);
                }
            } else {
                $element['@type'] = $this->identifierGenerator->getIdentifier($element['@type']);
            }
        }

        // 4
        if (\array_key_exists('@value', $element)) {
            // 4.1
            if (null === $list) {
                if (!\array_key_exists($activeProperty, $activeSubject)) {
                    $subjectNode[$activeProperty] = [$element];
                } else {
                    if (!array_search($element, $subjectNode[$activeProperty], true)) {
                        $subjectNode[$activeProperty][] = $element;
                    }
                }
            // 4.2
            } else {
                $list['@list'][] = $element;
            }
        // 5
        } elseif (\array_key_exists('@list', $element)) {
            // 5.1
            $result = ['@list' => []];

            // 5.2
            $this->buildNode($element['@list'], $activeGraph, $activeSubject, $activeProperty, $result);

            // 5.3
            if (null === $list) {
                $subjectNode[$activeProperty][] = $result;
            // 5.4
            } else {
                $list['@list'][] = $result;
            }
        // 6
        } else {
            // 6.1
            if (\array_key_exists('@id', $element)) {
                $id = $this->identifierGenerator->getIdentifier($element['@id']);
                unset($element['@id']);
            // 6.2
            } else {
                $id = $this->identifierGenerator->getIdentifier(null);
            }

            // 6.3
            if (!\array_key_exists($id, $graph)) {
                $graph[$id] = ['@id' => $id];
            }

            // 6.4
            $node = &$graph[$id];

            // 6.5
            if (\is_array($activeSubject)) {
                if (!\array_key_exists($activeProperty, $node)) {
                    $node[$activeProperty] = [$activeSubject];
                } elseif (!array_search($activeSubject, $node[$activeProperty], true)) {
                    $node[$activeProperty][] = $activeSubject;
                }
            // 6.6
            } elseif (null !== $activeProperty) {
                $reference = ['@id' => $id];

                if (null === $list) {
                    if (null === $subjectNode || !\array_key_exists($activeProperty, $subjectNode)) {
                        $subjectNode[$activeProperty] = $reference;
                    } elseif (!array_search($reference, $subjectNode[$activeProperty], true)) {
                        $subjectNode[$activeProperty][] = $reference;
                    }
                } else {
                    $list['@list'] = $reference;
                }
            }

            // 6.7
            if (\array_key_exists('@type', $element)) {
                foreach ((array) $element['@type'] as $type) {
                    if (!\array_key_exists('@type', $node)) {
                        $node['@type'] = [];
                    }

                    if (!array_search($type, $node['@type'], true)) {
                        $node['@type'][] = $type;
                    }
                }

                unset($element['@type']);
            }

            // 6.8
            if (\array_key_exists('@index', $element)) {
                if (\array_key_exists('@index', $node) && $node['@index'] !== $element['@index']) {
                    // TODO : implement real exceptions and catch them
                    throw new \Exception('Conflicting Index Exception : aborting processing');
                }

                $node['@index'] = $element['@index'];
                unset($element['@index']);
            }

            // 6.9
            if (\array_key_exists('@reverse', $element)) {
                $referencedNode = ['@id' => $id];
                $reverseMap = $element['@reverse'];

                foreach ($reverseMap as $property => $values) {
                    foreach ($values as $value) {
                        $this->buildNode($value, $activeGraph, $referencedNode, $property);
                    }
                }

                unset($element['@reverse']);
            }

            // 6.10
            if (\array_key_exists('@graph', $element)) {
                $this->buildNode($element['@graph'], $id);
                unset($element['@graph']);
            }

            // 6.11
            if (\array_key_exists('@included', $element)) {
                $this->buildNode($element['@included'], $activeGraph);
                unset($element['@included']);
            }

            // 6.12
            foreach ($element as $property => $value) {
                $property = $this->identifierGenerator->getIdentifier($property);

                if (!\array_key_exists($property, $node)) {
                    $node[$property] = [$value];
                }

                // $this->buildNode($value, $activeGraph, $id, $property);
            }
        }

        // $this->map[] = $graph;
        // $this->map[$graph[$id]['@id']] = $graph[$id];
    }

    private function isCollection($element): bool
    {
        return \is_object($element) && \stdClass::class === \get_class($element);
    }
}
