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
use Jolicode\JsonLd\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Http\DocumentLoader;
use Jolicode\JsonLd\Http\IriResolver;
use Jolicode\JsonLd\JsonLd\FramingKeyword;
use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Services\ValueAdder;
use Jolicode\JsonLd\TermDefinition\TermDefinition;

class Expander
{
    public function __construct(
        private ContextProcesser $contextProcesser = new ContextProcesser(),
    ) {
    }

    public function parseJson(string $json, ProcessorOptions $options = new ProcessorOptions()): ?string
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

        if ($options->expandContext) {
            $this->contextProcesser->processContext($activeContext, $options->expandContext, $activeContext->baseUrl);
        }

        return json_encode($this->expand(
            $element,
            $options,
            activeContext: $activeContext,
            activeProperty: null,
            baseUrl: $baseUrl,
        ));
    }

    /**
     * Takes a json_decoded JSON element as input and returns it expanded.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld-api/#expansion-algorithm. It is based on the 16th July 2020 recommendation.
     */
    private function expand(
        mixed $element,
        ProcessorOptions $options,
        ?string $baseUrl = null,
        Context $activeContext = new Context(),
        ?string $activeProperty = FramingKeyword::DEFAULT->value,
        bool $fromMap = false,
    ): \stdClass|array|null {
        // 1
        if (null === $element) {
            return null;
        }

        // 2
        if (FramingKeyword::DEFAULT->value === $activeProperty) {
            $options->frameExpansion = false;
        }

        // 3
        if (\array_key_exists($activeProperty, $activeContext->termDefinitions) && $activeContext->termDefinitions[$activeProperty]->context) {
            $propertyScopedContext = $activeContext->termDefinitions[$activeProperty]->context;
        }

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
                    $activeContext->termDefinitions[$activeProperty]->baseUrl
                );
            }

            // 4.3
            return $this->expandValue($activeContext, $activeProperty, $element);
        }

        // 5
        if (\is_array($element)) {
            // 5.1
            $result = [];

            // 5.2
            foreach ($element as $item) {
                $expandedItem = $this->expand(
                    $item,
                    $options,
                    $baseUrl,
                    $activeContext,
                    $activeProperty,
                    $fromMap
                );

                if (
                    \array_key_exists($activeProperty, $activeContext->termDefinitions) &&
                    $activeContext->termDefinitions[$activeProperty]->containerMapping &&
                    \in_array(Keyword::LIST->value, $activeContext->termDefinitions[$activeProperty]->containerMapping, true) &&
                    \is_array($expandedItem)
                ) {
                    $expandedItem = (object) [Keyword::LIST->value => $expandedItem];
                }

                if (\is_array($expandedItem)) {
                    $result = [...$result, ...$expandedItem];
                } elseif (null !== $expandedItem) {
                    $result[] = $expandedItem;
                }
            }

            // 5.3
            return $result;
        }

        // 6
        $element = (object) $element;

        // 7
        if ($activeContext->previousContext) {
            if (!$fromMap) {
                $switchToPreviousContext = true;

                if (
                    1 === \count((array) $element) &&
                    Keyword::ID->value === IriResolver::expand($activeContext, array_keys(get_object_vars($element))[0])
                ) {
                    $switchToPreviousContext = false;
                }

                foreach ($element as $elementKey => $elementEntry) {
                    if (\is_string($elementEntry) && Keyword::VALUE->value === IriResolver::expand($activeContext, $elementKey)) {
                        $switchToPreviousContext = false;

                        break;
                    }
                }

                if ($switchToPreviousContext) {
                    $activeContext = $activeContext->previousContext;
                }
            }
        }

        // 8
        if (isset($propertyScopedContext)) {
            $activeContext = $this->contextProcesser->processContext(
                $activeContext,
                $propertyScopedContext,
                $baseUrl,
                overrideProtected: true
            );
        }

        // 9
        if (property_exists($element, Keyword::CONTEXT->value)) {
            $activeContext = $this->contextProcesser->processContext(
                $activeContext,
                $element->{Keyword::CONTEXT->value},
                $baseUrl,
                overrideProtected: true,
            );
        }

        // 10
        $typeScopedContext = $activeContext;
        $inputType = [];

        // 11
        foreach ($element as $key => $value) {
            if (Keyword::TYPE->value !== IriResolver::expand($activeContext, $key)) {
                continue;
            }

            // 11.1
            $arrayValue = (array) $value;

            // 12 : we do 12 here, so we don't loop twice over $element
            $inputType = [
                IriResolver::expand($activeContext, $key) => IriResolver::expand($activeContext, $arrayValue[array_key_last($arrayValue)]),
            ];

            sort($arrayValue);

            // 11.2
            foreach ($arrayValue as $term) {
                if (
                    \is_string($term) &&
                    \array_key_exists($term, $typeScopedContext->termDefinitions) &&
                    $typeScopedContext->termDefinitions[$term]->context
                ) {
                    $activeContext = $this->contextProcesser->processContext(
                        $activeContext,
                        $typeScopedContext->termDefinitions[$term]->context,
                        $typeScopedContext->termDefinitions[$term]->baseUrl,
                        propagate: false
                    );
                }
            }
        }

        // 12
        $result = [];
        $nests = [];

        // 13
        $this->processElementEntries(
            $element,
            $activeContext,
            $result,
            $nests,
            $activeProperty,
            $options,
            $typeScopedContext,
            $baseUrl,
            $inputType,
            $activeContext->termDefinitions
        );

        // 14
        $this->processNestEntries(
            $element,
            $activeContext,
            $result,
            $nests,
            $activeProperty,
            $options,
            $typeScopedContext,
            $baseUrl,
            $inputType,
            $activeContext->termDefinitions
        );

        $result = (object) $result;

        // 15
        if (property_exists($result, Keyword::VALUE->value)) {
            // 15.1
            $this->validateResultValue($result);

            // 15.2
            if (property_exists($result, Keyword::TYPE->value) && Keyword::JSON->value === $result->{Keyword::TYPE->value}) {
                // TODO: not sure how to treat value as a JSON litteral. Do nothing ? json_encode ?
                // 15.3
            } elseif (null === $result->{Keyword::VALUE->value} || [] === $result->{Keyword::VALUE->value}) {
                return null;
            // 15.4
            } elseif (!\is_string($result->{Keyword::VALUE->value}) && property_exists($result, Keyword::LANGUAGE->value)) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('invalid language-tagged value');
            // 15.5
            } elseif (property_exists($result, Keyword::TYPE->value) && !IriResolver::isIri($result->{Keyword::TYPE->value})) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('invalid typed value');
            }
        // 16
        } elseif (property_exists($result, Keyword::TYPE->value) && !\is_array($result->{Keyword::TYPE->value})) {
            $result->{Keyword::TYPE->value} = [$result->{Keyword::TYPE->value}];
        // 17
        } elseif (
            property_exists($result, Keyword::SET->value) ||
            property_exists($result, Keyword::LIST->value)
        ) {
            // 17.1
            if (2 < \count(get_object_vars($result))) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('invalid set or list object');
            }

            // 17.1
            if (2 === \count(get_object_vars($result)) && !property_exists($result, $result->{Keyword::INDEX->value})) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('invalid set or list object');
            }

            // 17.2
            if (property_exists($result, Keyword::SET->value)) {
                $result = $result->{Keyword::SET->value};
            }
        }

        // 18
        if (\is_object($result) && 1 === \count(get_object_vars($result)) && property_exists($result, Keyword::LANGUAGE->value)) {
            return [];
        }

        // 19
        if (null === $activeProperty || Keyword::GRAPH->value === $activeProperty) {
            // 19.1
            if (\is_object($result)) {
                if (0 === \count(get_object_vars($result))) {
                    return [];
                }

                if (
                    1 === \count(get_object_vars($result)) &&
                    (property_exists($result, Keyword::VALUE->value) || property_exists($result, Keyword::LIST->value))
                ) {
                    return [];
                }

                // 19.2
                if (1 === \count(get_object_vars($result)) && property_exists($result, Keyword::ID->value)) {
                    if ($options->frameExpansion) {
                        $result = (object) [Keyword::ID->value => null];
                    } else {
                        return [];
                    }
                }
            }
        }

        if (null === $activeProperty) {
            if (
                \is_object($result) &&
                property_exists($result, Keyword::GRAPH->value) &&
                1 === \count(get_object_vars($result))
            ) {
                // As written in https://www.w3.org/TR/json-ld11/#dfn-graph-object, a top-level object consisting of @graph is not a graph object, so we remove the @graph entry
                $result = $result->{Keyword::GRAPH->value};
            }
        }

        // 20
        return \is_array($result) ? $result : [$result];
    }

    /**
     * Expand compacted values.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld11-api/#value-expansion. It is based on the 16th July 2020 recommendation.
     */
    private function expandValue(Context $activeContext, string $activeProperty, mixed $value): \stdClass|array
    {
        if (\array_key_exists($activeProperty, $activeContext->termDefinitions)) {
            /** @var TermDefinition $definition */
            $definition = $activeContext->termDefinitions[$activeProperty];

            // 1
            if (
                Keyword::ID->value === $definition->typeMapping &&
                \is_string($value)
            ) {
                return (object) [Keyword::ID->value => IriResolver::expand($activeContext, $value, true, false)];
            }

            // 2
            if (
                Keyword::VOCAB->value === $definition->typeMapping &&
                \is_string($value)
            ) {
                return (object) [Keyword::ID->value => IriResolver::expand($activeContext, $value, true)];
            }
        }

        // 3
        $result = [Keyword::VALUE->value => $value];

        // 4
        if (
            isset($definition) &&
            $definition->typeMapping &&
            !\in_array($definition->typeMapping, [Keyword::ID->value, Keyword::VOCAB->value, Keyword::NONE->value], true)
        ) {
            $result[Keyword::TYPE->value] = $definition->typeMapping;
        // 5
        } elseif (\is_string($value)) {
            // 5.1
            if (isset($definition)) {
                $language = $definition->languageMapping;
            } else {
                $language = $activeContext->defaultLangage;
            }

            // 5.3
            if (null !== $language) {
                $result[Keyword::LANGUAGE->value] = $language;
            }

            // 5.2
            if (isset($definition)) {
                $direction = $definition->directionMapping;
            } else {
                $direction = $activeContext->defaultBaseDirection;
            }

            // 5.4
            if (null !== $direction) {
                $result[Keyword::DIRECTION->value] = $direction;
            }
        }

        // 6
        return (object) $result;
    }

    private function processElementEntries(
        mixed $element,
        Context $activeContext,
        array|\stdClass &$result,
        array &$nests,
        ?string $activeProperty,
        ProcessorOptions $options,
        Context $typeScopedContext,
        string $baseUrl,
        array $inputType,
        array $activeDefinitions,
    ): void {
        $nests = [];

        foreach ($element as $key => $value) {
            // 13.1
            if (Keyword::CONTEXT->value === $key) {
                continue;
            }

            // 13.2
            $expandedProperty = IriResolver::expand($activeContext, $key);

            // 13.3
            if (!$expandedProperty || (!str_contains($expandedProperty, ':') && !Keyword::tryFrom($expandedProperty))) {
                continue;
            }

            // 13.4
            if (Keyword::tryFrom($expandedProperty)) {
                // 13.4.1
                if (Keyword::REVERSE->value === $activeProperty) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid reverse property map');
                }

                $result = (array) $result;
                $expandedValue = [];

                // 13.4.2
                if (
                    \array_key_exists($expandedProperty, $result) &&
                    $expandedProperty !== Keyword::INCLUDED->value &&
                    $expandedProperty !== Keyword::TYPE->value
                ) {
                    // TODO: json-ld-1.0 processing mode
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('colliding keywords');
                }

                // 13.4.3
                if (Keyword::ID->value === $expandedProperty) {
                    // 13.4.3.1
                    if (!\is_string($value) && !$options->frameExpansion) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid @id value');
                    }

                    // 13.4.3.2
                    if ($options->frameExpansion) {
                        foreach ((array) $value as $valueEntry) {
                            $expandedValue[] = IriResolver::expand($activeContext, $valueEntry, true, false);
                        }
                    } else {
                        $expandedValue = IriResolver::expand($activeContext, $value, true, false);
                    }
                }

                // 13.4.4
                if (Keyword::TYPE->value === $expandedProperty) {
                    // 13.4.4.1
                    $this->validateValueForType($value, $options);

                    // 13.4.4.2
                    if (\is_object($value) && !\count((array) $value)) {
                        $expandedValue = $value;
                    // 13.4.4.3
                    } elseif (\is_object($value) && property_exists($value, FramingKeyword::DEFAULT->value)) {
                        $expandedValue = new \stdClass();
                        $expandedValue->{FramingKeyword::DEFAULT->value} = IriResolver::expand(
                            $typeScopedContext,
                            $value->{FramingKeyword::DEFAULT->value},
                            true
                        );
                    // 13.4.4.4
                    } else {
                        foreach ((array) $value as $valueEntry) {
                            $expandedValue[] = IriResolver::expand($typeScopedContext, $valueEntry, true);
                        }
                    }

                    // 13.4.4.5
                    if (\array_key_exists(Keyword::TYPE->value, $result)) {
                        if (\is_array($result[Keyword::TYPE->value])) {
                            $expandedValue = [...$result[Keyword::TYPE->value], ...$expandedValue];
                        } else {
                            $expandedValue = [$result[Keyword::TYPE->value], ...$expandedValue];
                        }
                    }

                    if (1 === \count($expandedValue)) {
                        $expandedValue = $expandedValue[0];
                    }
                }

                // 13.4.5
                if (Keyword::GRAPH->value === $expandedProperty) {
                    $expandedValue = $this->expand(
                        $value,
                        $options,
                        $baseUrl,
                        $activeContext,
                        Keyword::GRAPH->value
                    );

                    if (!\is_array($expandedValue)) {
                        $expandedValue = (array) $expandedValue;
                    }

                    foreach ($expandedValue as $valueEntry) {
                        if (!\is_object($valueEntry)) {
                            $valueEntry = (object) $valueEntry;
                        }
                    }
                }

                // 13.4.6
                if (Keyword::INCLUDED->value === $expandedProperty) {
                    // 13.4.6.1
                    // TODO: json-ld-1.0 processing mode

                    // 13.4.6.2
                    $expandedValue = (array) $this->expand(
                        $value,
                        $options,
                        $baseUrl,
                        $activeContext,
                        null
                    );

                    // 13.4.6.3
                    foreach ($expandedValue as $expandedElement) {
                        if (!\is_object($expandedElement)) {
                            // TODO: The if is probably wrong. Check how to validate a node object.
                            // TODO: implement real exceptions and catch them
                            throw new \Exception('invalid @included value');
                        }
                    }

                    // 13.4.6.4
                    if (\array_key_exists(Keyword::INCLUDED->value, $result)) {
                        $expandedValue = [...$result[Keyword::INCLUDED->value], ...$expandedValue];
                    }
                }

                // 13.4.7
                if (Keyword::VALUE->value === $expandedProperty) {
                    // 13.4.7.1
                    if (\in_array(Keyword::JSON->value, $inputType, true)) {
                        $expandedValue = $value;
                    // TODO: json-ld-1.0 processing mode
                    } else {
                        // 13.4.7.2
                        $this->validateValueForValue($value, $options);

                        // 13.4.7.3
                        $expandedValue = $value;

                        if ($options->frameExpansion) {
                            $expandedValue = (array) $expandedValue;
                        }
                    }

                    // 13.4.7.4
                    if (null === $expandedValue) {
                        $result[Keyword::VALUE->value] = null;

                        continue;
                    }
                }

                // 13.4.8
                if (Keyword::LANGUAGE->value === $expandedProperty) {
                    // 13.4.8.1
                    $this->validateValueForLanguage($value, $options);

                    // 13.4.8.2
                    // TODO: Add check that language is correctly formed.
                    $expandedValue = $options->frameExpansion ? (array) $value : $value;
                }

                // 13.4.9
                if (Keyword::DIRECTION->value === $expandedProperty) {
                    // 13.4.9.1
                    // TODO: json-ld-1.0 processing mode

                    // 13.4.9.2
                    if (!\in_array($value, ['ltr', 'rtl'], true)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid base direction');
                    }

                    // 13.4.9
                    $expandedValue = $options->frameExpansion ? (array) $value : $value;
                }

                // 13.4.10
                if (Keyword::INDEX->value === $expandedProperty) {
                    // 13.4.10.1
                    if (!\is_string($value)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid @index value');
                    }

                    // 13.4.10.2
                    $expandedValue = $value;
                }

                // 13.4.11
                if (Keyword::LIST->value === $expandedProperty) {
                    // 13.4.11.1
                    if (null === $activeProperty || Keyword::GRAPH->value === $activeProperty) {
                        continue;
                    }

                    // 13.4.11.2
                    $expandedValue = $this->expand(
                        $value,
                        $options,
                        $baseUrl,
                        $activeContext,
                        $activeProperty,
                    );
                }

                // 13.4.12
                if (Keyword::SET->value === $expandedProperty) {
                    $expandedValue = $this->expand(
                        $value,
                        $options,
                        $baseUrl,
                        $activeContext,
                        $activeProperty,
                    );
                }

                // 13.4.13
                if (Keyword::REVERSE->value === $expandedProperty) {
                    // 13.4.13.1
                    if (!\is_object($value)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid @reverse value');
                    }

                    // 13.4.13.2
                    $expandedValue = $this->expand(
                        $value,
                        $options,
                        $baseUrl,
                        $activeContext,
                        Keyword::REVERSE->value,
                    );

                    $expandedValue = $expandedValue[0];

                    // 13.4.13.3
                    if (property_exists($expandedValue, Keyword::REVERSE->value)) {
                        // 13.4.13.3.1
                        foreach ($expandedValue->{Keyword::REVERSE->value} as $property => $item) {
                            $result = ValueAdder::addValue($item, $property, $result, true);
                        }
                    }

                    // 13.4.13.4
                    if (!property_exists($expandedValue, Keyword::REVERSE->value)) {
                        // 13.4.13.4.1
                        $reverseMap = $result[Keyword::REVERSE->value] ?? new \stdClass();

                        // 13.4.13.4.2
                        foreach ($expandedValue as $property => $items) {
                            if (Keyword::REVERSE->value === $property) {
                                continue;
                            }

                            // 13.4.13.4.2.1
                            foreach ($items as $itemKey => $itemValue) {
                                // 13.4.13.4.2.1.1
                                if (property_exists((object) $itemValue, Keyword::VALUE->value) || property_exists((object) $itemValue, Keyword::VALUE->value)) {
                                    // TODO: implement real exceptions and catch them
                                    throw new \Exception('invalid @reverse property value');
                                }

                                // 13.4.13.4.2.1.2
                                $reverseMap = ValueAdder::addValue($itemValue, $property, $reverseMap, true);
                            }
                        }

                        $result[$expandedProperty] = $reverseMap;
                    }

                    // 13.4.13.5
                    continue;
                }

                // 13.4.14
                if (Keyword::NEST->value === $expandedProperty) {
                    $nests[] = $key ?: [];

                    continue;
                }

                // 13.4.15
                if ($options->frameExpansion) {
                    if (FramingKeyword::tryFrom($expandedProperty)) {
                        $expandedValue = $this->expand(
                            $value,
                            $options,
                            $baseUrl,
                            $activeContext,
                            $activeProperty,
                        );
                    }
                }

                // 13.4.16
                if (
                    null !== $expandedValue ||
                    Keyword::VALUE->value !== $expandedProperty ||
                    !\in_array(Keyword::JSON->value, $inputType, true)
                ) {
                    $result[$expandedProperty] = $expandedValue;
                }

                // 13.4.17
                continue;
            }

            if (!\array_key_exists($key, $activeDefinitions)) {
                $containerMapping = null;
                $keyDefinition = null;
            } else {
                /** @var TermDefinition $keyDefinition */
                $keyDefinition = $activeDefinitions[$key];

                // 13.5
                $containerMapping = $keyDefinition->containerMapping;
            }

            // 13.6
            if (
                $keyDefinition &&
                Keyword::JSON->value === $keyDefinition->typeMapping
            ) {
                $expandedValue = new \stdClass();
                $expandedValue->{Keyword::VALUE->value} = $value;
                $expandedValue->{Keyword::TYPE->value} = Keyword::JSON->value;
            // 13.7
            } elseif ($containerMapping && \in_array(Keyword::LANGUAGE->value, $containerMapping, true) && \is_object($value)) {
                // 13.7.1
                $expandedValue = [];

                // 13.7.2
                $direction = $activeContext->defaultBaseDirection;

                // 13.7.3
                if ($keyDefinition->directionMapping) {
                    $direction = $keyDefinition->directionMapping;
                }

                // 13.7.4
                foreach ($value as $language => $languageValue) {
                    // 13.7.4.1
                    if (!\is_array($languageValue)) {
                        $languageValue = [$languageValue];
                    }

                    // 13.7.4.2
                    foreach ($languageValue as $item) {
                        // 13.7.4.2.1
                        if (null === $item) {
                            continue;
                        }

                        // 13.7.4.2.2
                        if (!\is_string($item)) {
                            // TODO: implement real exceptions and catch them
                            throw new \Exception('invalid language map');
                        }

                        // 13.7.4.2.3
                        // TODO: Add check that language is correctly formed.
                        $newValue = (object) [
                            Keyword::VALUE->value => $item,
                            Keyword::LANGUAGE->value => $language,
                        ];

                        // 13.7.4.2.4
                        if (Keyword::NONE->value === $language || Keyword::NONE->value === IriResolver::expand($activeContext, $language)) {
                            unset($newValue->{Keyword::LANGUAGE->value});
                        }

                        // 13.7.4.2.5
                        if (null !== $direction) {
                            $newValue->{Keyword::DIRECTION->value} = $direction;
                        }

                        $expandedValue[] = $newValue;
                    }
                }
            // 13.8
            } elseif (
                \is_object($value) &&
                $containerMapping &&
                \count(array_intersect($containerMapping, [
                    Keyword::INDEX->value, Keyword::TYPE->value, Keyword::ID->value,
                ]))
            ) {
                // 13.8.1
                $expandedValue = [];

                // 13.8.2
                $indexKey = $keyDefinition->indexMapping ?: Keyword::INDEX->value;

                // 13.8.3
                foreach ($value as $index => $indexValue) {
                    // 13.8.3.1
                    if (\in_array(Keyword::ID->value, $containerMapping, true) || \in_array(Keyword::TYPE->value, $containerMapping, true)) {
                        $mapContext = $activeContext->previousContext ?: $activeContext;
                    } else {
                        $mapContext = $activeContext;
                    }

                    // 13.8.3.2
                    if (
                        \in_array(Keyword::TYPE->value, $containerMapping, true) &&
                        \array_key_exists($index, $mapContext->termDefinitions) &&
                        $mapContext->termDefinitions[$index]->context
                    ) {
                        $mapContext = $this->contextProcesser->processContext(
                            $mapContext,
                            $mapContext->termDefinitions[$index]->context,
                            $mapContext->termDefinitions[$index]->baseUrl
                        );
                    // 13.8.3.3
                    } else {
                        $mapContext = $activeContext;
                    }

                    // 13.8.3.4
                    $expandedIndex = IriResolver::expand($activeContext, $index);

                    // 13.8.3.5
                    if (!\is_array($indexValue)) {
                        $indexValue = [$indexValue];
                    }

                    // 13.8.3.6
                    $indexValue = $this->expand(
                        $indexValue,
                        $options,
                        $baseUrl,
                        $mapContext,
                        $key,
                        true
                    );

                    // 13.8.3.7
                    foreach ($indexValue as $item) {
                        // 13.8.3.7.1
                        if (\in_array(Keyword::GRAPH->value, $containerMapping, true) && !$this->isGraphObject($item)) {
                            $item = (object) [Keyword::GRAPH->value => [$item]];
                        }

                        // 13.8.3.7.2
                        if (
                            \in_array(Keyword::INDEX->value, $containerMapping, true) &&
                            Keyword::INDEX->value !== $indexKey &&
                            Keyword::NONE->value !== $expandedIndex
                        ) {
                            // 13.8.3.7.2.1
                            $reExpandedIndex = $this->expandValue($activeContext, $indexKey, $index);

                            // 13.8.3.7.2.2
                            $expandedIndexKey = IriResolver::expand($activeContext, $indexKey);

                            // 13.8.3.7.2.3
                            $indexPropertyValues = [$reExpandedIndex];

                            if (property_exists($item, $expandedIndexKey)) {
                                $indexPropertyValues[] = $item->$expandedIndexKey[0];
                            }

                            // 13.8.3.7.2.4
                            $item->$expandedIndexKey = $indexPropertyValues;

                            // 13.8.3.7.2.5
                            if ($this->isValueObject($item)) {
                                if (1 < \count((array) $item)) {
                                    // TODO: implement real exceptions and catch them
                                    throw new \Exception('invalid value object');
                                }
                            }
                        } elseif (
                            // 13.8.3.7.3
                            \in_array(Keyword::INDEX->value, $containerMapping, true) &&
                            !property_exists($item, Keyword::INDEX->value) &&
                            Keyword::NONE->value !== $expandedIndex
                        ) {
                            // This looks weird but this is because the index entry should be above the graph entry
                            if (property_exists($item, Keyword::GRAPH->value)) {
                                $graphValue = $item->{Keyword::GRAPH->value};
                                unset($item->{Keyword::GRAPH->value});

                                $item->{Keyword::INDEX->value} = $index;
                                $item->{Keyword::GRAPH->value} = $graphValue;
                            } else {
                                $item->{Keyword::INDEX->value} = $index;
                            }
                        } elseif (
                            // 13.8.3.7.4
                            \in_array(Keyword::ID->value, $containerMapping, true) &&
                            !property_exists($item, Keyword::ID->value) &&
                            Keyword::NONE->value !== $expandedIndex
                        ) {
                            $expandedIndex = IriResolver::expand($activeContext, $index, true);
                            $item->{Keyword::ID->value} = $expandedIndex;
                        } elseif (
                            // 13.8.3.7.5
                            \in_array(Keyword::TYPE->value, $containerMapping, true) &&
                            Keyword::NONE->value !== $expandedIndex
                        ) {
                            $types = [
                                $expandedIndex,
                            ];

                            if (property_exists($item, Keyword::TYPE->value)) {
                                $types = [...$types, ...$item->{Keyword::TYPE->value}];
                            }

                            $item->{Keyword::TYPE->value} = $types;
                        }

                        // 13.8.3.7.6
                        $expandedValue[] = $item;
                    }
                }
            } else {
                // 13.9
                $expandedValue = $this->expand(
                    $value,
                    $options,
                    $baseUrl,
                    $activeContext,
                    $key
                );
            }

            // 13.10
            if (null === $expandedValue) {
                continue;
            }

            // 13.11
            if (
                $containerMapping &&
                \in_array(Keyword::LIST->value, $containerMapping, true) &&
                !$this->isListObject($expandedValue)
            ) {
                if (!\is_array($expandedValue)) {
                    $expandedValue = [$expandedValue];
                }

                $expandedValue = (object) [Keyword::LIST->value => $expandedValue];
            }

            // 13.12
            if (
                $containerMapping &&
                \in_array(Keyword::GRAPH->value, $containerMapping, true) &&
                !\in_array(Keyword::ID->value, $containerMapping, true) &&
                !\in_array(Keyword::INDEX->value, $containerMapping, true)
            ) {
                // 13.12.1
                foreach ((array) $expandedValue as $key => $expandedEntry) {
                    $graphExpandedValue[] = (object) [Keyword::GRAPH->value => [(object) $expandedEntry]];
                }

                $expandedValue = $graphExpandedValue;
            }

            $result = (array) $result;

            // 13.13
            if (\array_key_exists($key, $activeDefinitions) && $activeDefinitions[$key]->reverseProperty) {
                // 13.13.1
                if (!\array_key_exists(Keyword::REVERSE->value, $result)) {
                    $result[Keyword::REVERSE->value] = new \stdClass();
                }

                // 13.13.2
                $reverseMap = $result[Keyword::REVERSE->value];

                // 13.13.3
                if (!\is_array($expandedValue)) {
                    $expandedValue = [$expandedValue];
                }

                // 13.13.4
                foreach ($expandedValue as $item) {
                    if ($this->isValueObject($item) || $this->isListObject($item)) {
                        // 13.13.4.1
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid reverse property value');
                    }

                    // 13.13.4.2
                    if (!property_exists($reverseMap, $expandedProperty)) {
                        $reverseMap->$expandedProperty = [];
                    }

                    // 13.13.4.3
                    ValueAdder::addValue($item, $expandedProperty, $reverseMap, true);
                }
            } else {
                // 13.14
                $result = ValueAdder::addValue($expandedValue, $expandedProperty, $result, true);
            }
        }
    }

    private function processNestEntries(
        mixed $element,
        Context $activeContext,
        array|\stdClass &$result,
        array $nests,
        ?string $activeProperty,
        ProcessorOptions $options,
        Context $typeScopedContext,
        string $baseUrl,
        array $inputType,
        array $activeDefinitions,
    ): void {
        foreach ($nests as $nestingKey) {
            $element = (array) $element;

            // 14.1
            $nestedValues = $element[$nestingKey];

            if (!\is_array($nestedValues)) {
                $nestedValues = [$nestedValues];
            }

            // 14.2
            foreach ($nestedValues as $nestedValue) {
                // 14.2.1
                // TODO: check is_object vs is_array
                if (!\is_object($nestedValue)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid @nest value');
                }

                // 14.2.1
                foreach ($nestedValue as $key => $value) {
                    if (Keyword::VALUE->value === IriResolver::expand($activeContext, $key)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid @nest value');
                    }
                }

                // 14.2.2
                $this->processElementEntries(
                    $nestedValue,
                    $activeContext,
                    $result,
                    $nests,
                    $activeProperty,
                    $options,
                    $typeScopedContext,
                    $baseUrl,
                    $inputType,
                    $activeDefinitions
                );

                $this->processNestEntries(
                    $nestedValue,
                    $activeContext,
                    $result,
                    $nests,
                    $activeProperty,
                    $options,
                    $typeScopedContext,
                    $baseUrl,
                    $inputType,
                    $activeDefinitions
                );
            }
        }
    }

    // 13.4.4.1
    private function validateValueForType(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion && \is_object($value)) {
            if (new \stdClass() === $value) {
                return true;
            }

            if (
                property_exists($value, FramingKeyword::DEFAULT->value) &&
                IriResolver::isIri($value->{FramingKeyword::DEFAULT->value})
            ) {
                return true;
            }
        }

        if (\is_array($value)) {
            foreach ($value as $valueEntry) {
                if (!\is_string($valueEntry)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid type value');
                }
            }

            return true;
        }

        if (\is_string($value)) {
            return true;
        }

        // TODO: implement real exceptions and catch them
        throw new \Exception('invalid type value');
    }

    // 13.4.7.2
    private function validateValueForValue(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion) {
            if (new \stdClass() === $value) {
                return true;
            }

            if (\is_array($value)) {
                foreach ($value as $valueEntry) {
                    if (!\is_scalar($valueEntry)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid type value');
                    }
                }

                return true;
            }
        }

        if (\is_scalar($value) || null === $value) {
            return true;
        }

        // TODO: implement real exceptions and catch them
        throw new \Exception('invalid value object value');
    }

    // 13.4.8.1
    private function validateValueForLanguage(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion) {
            if (new \stdClass() === $value) {
                return true;
            }

            if (\is_array($value)) {
                foreach ($value as $valueEntry) {
                    if (!\is_string($valueEntry)) {
                        // TODO: implement real exceptions and catch them
                        throw new \Exception('invalid type value');
                    }
                }

                return true;
            }
        }

        if (\is_string($value)) {
            return true;
        }

        // TODO: implement real exceptions and catch them
        throw new \Exception('invalid language-tagged string');
    }

    private function validateResultValue(\stdClass $result): bool
    {
        if (
            (property_exists($result, Keyword::LANGUAGE->value) || property_exists($result, Keyword::DIRECTION->value)) &&
            property_exists($result, Keyword::TYPE->value)
        ) {
            // TODO: implement real exceptions and catch them
            throw new \Exception('invalid value object');
        }

        foreach ($result as $resultKey => $resultEntry) {
            if (!\in_array(
                $resultKey,
                [Keyword::DIRECTION->value, Keyword::INDEX->value, Keyword::LANGUAGE->value, Keyword::TYPE->value, Keyword::VALUE->value],
                true
            )) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('invalid value object');
            }
        }

        return true;
    }

    private function isGraphObject(mixed $object): bool
    {
        if (!\is_object($object)) {
            return false;
        }

        if (property_exists($object, Keyword::GRAPH->value)) {
            return true;
        }

        return false;
    }

    private function isValueObject(mixed $object): bool
    {
        return \is_object($object) && property_exists($object, Keyword::VALUE->value);
    }

    private function isListObject(mixed $object): bool
    {
        if (!\is_object($object) || !property_exists($object, Keyword::LIST->value)) {
            return false;
        }

        if (property_exists($object, Keyword::INDEX->value)) {
            return 2 === \count((array) $object);
        }

        return 1 === \count((array) $object);
    }
}
