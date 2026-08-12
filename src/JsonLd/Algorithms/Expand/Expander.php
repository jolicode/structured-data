<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Expand;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextCache;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ExpansionException;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\ValueAdder;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;

class Expander
{
    /**
     * Sentinel used as the default active property of doExpand(), marking a
     * top-level invocation. It is distinct from the real "@default" framing
     * keyword, which can legitimately appear as an active property when
     * expanding a frame.
     */
    public const TOP_LEVEL_ACTIVE_PROPERTY = "\0top-level\0";

    private ContextProcessor $contextProcessor;
    private DocumentLoaderInterface $documentLoader;

    public function __construct(
        ?ContextProcessor $contextProcessor = null,
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $this->documentLoader = $documentLoader ?? new HttpDocumentLoader();
        $this->contextProcessor = $contextProcessor ?? new ContextProcessor(new ContextCache($this->documentLoader));
    }

    /**
     * @param string|\stdClass $json         The JSON-LD document to expand. It can be a URI, a JSON string or a JSON object.
     * @param ProcessorOptions $options      options to use when expanding the document
     * @param bool             $encodeResult Whether to encode the result as a JSON string or not.
     *
     * see https://www.w3.org/TR/json-ld11/#expansion-algorithm
     */
    public function expand(
        string|\stdClass $json,
        ProcessorOptions $options = new ProcessorOptions(),
        bool $encodeResult = true,
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

        $activeContext = new Context(
            baseIri: $baseUrl,
            baseUrl: $baseUrl,
            processingMode: $options->processingMode,
        );

        if ($options->expandContext) {
            $activeContext = $this->contextProcessor->processContext($activeContext, $options->expandContext, $activeContext->baseUrl);
        }

        $element = $this->doExpand(
            $element,
            $options,
            activeContext: $activeContext,
            activeProperty: null,
            baseUrl: $baseUrl,
        );

        if ($encodeResult) {
            return json_encode($element, \JSON_PRETTY_PRINT);
        }

        return $element;
    }

    /**
     * Takes a json_decoded JSON element as input and returns it expanded.
     *
     * This is a PHP implementation of the Expansion algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld-api/#expansion-algorithm
     */
    public function doExpand(
        mixed $element,
        ProcessorOptions $options,
        ?string $baseUrl = null,
        Context $activeContext = new Context(),
        ?string $activeProperty = self::TOP_LEVEL_ACTIVE_PROPERTY,
        bool $fromMap = false,
    ): \stdClass|array|null {
        // 1
        if (null === $element) {
            return null;
        }

        // 2
        if (self::TOP_LEVEL_ACTIVE_PROPERTY === $activeProperty) {
            $options->frameExpansion = false;
        }

        // 3
        if (null !== $activeProperty && \array_key_exists($activeProperty, $activeContext->termDefinitions) && false !== $activeContext->termDefinitions[$activeProperty]->context) {
            $propertyScopedContext = $activeContext->termDefinitions[$activeProperty]->context;
        } else {
            $propertyScopedContext = false;
        }

        // 4
        if (\is_scalar($element)) {
            return $this->handleScalarElement($activeContext, $element, $activeProperty, $propertyScopedContext);
        }

        // 5
        if (\is_array($element)) {
            return $this->handleArrayElement($activeContext, $element, $options, $baseUrl, $activeProperty, $fromMap);
        }

        // 6
        $element = (object) $element;

        // 7
        if ($activeContext->previousContext) {
            $activeContext = $this->handlePreviousContext($activeContext, $element, $fromMap);
        }

        // 8
        if (false !== $propertyScopedContext) {
            $activeContext = $this->contextProcessor->processContext(
                $activeContext,
                $propertyScopedContext,
                $baseUrl,
                overrideProtected: true,
            );
        }

        // 9
        if (property_exists($element, Keyword::CONTEXT->value)) {
            $activeContext = $this->contextProcessor->processContext(
                $activeContext,
                $element->{Keyword::CONTEXT->value},
                $baseUrl,
            );
        }

        // 10
        $typeScopedContext = $activeContext;
        $inputType = [];

        // 11
        $this->handleTypeEntries($activeContext, $element, $typeScopedContext, $inputType, $options);

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
            $activeContext->termDefinitions,
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
            $activeContext->termDefinitions,
        );

        $result = (object) $result;

        // 15
        if (property_exists($result, Keyword::VALUE->value)) {
            if (false === $this->handleResultValueEntry($result, $options)) {
                return null;
            }
        // 16
        } elseif (property_exists($result, Keyword::TYPE->value) && !\is_array($result->{Keyword::TYPE->value})) {
            $result->{Keyword::TYPE->value} = [$result->{Keyword::TYPE->value}];
        // 17
        } elseif (
            property_exists($result, Keyword::SET->value)
            || property_exists($result, Keyword::LIST->value)
        ) {
            $this->handleResultSetAndListEntries($result);
        }

        // 18
        // @phpstan-ignore function.alreadyNarrowedType
        if (\is_object($result) && 1 === \count(get_object_vars($result)) && property_exists($result, Keyword::LANGUAGE->value)) {
            return null;
        }

        // 19
        if (null === $activeProperty || Keyword::GRAPH->value === $activeProperty) {
            if ($this->handleNullPropertyAndGraphProperty($result, $options)) {
                return [];
            }
        }

        if (null === $activeProperty || self::TOP_LEVEL_ACTIVE_PROPERTY === $activeProperty) {
            if (
                \is_object($result)
                && property_exists($result, Keyword::GRAPH->value)
                && 1 === \count(get_object_vars($result))
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
     * This is a PHP implementation of the Value Expansion algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld11-api/#value-expansion
     */
    private function expandValue(Context $activeContext, string $activeProperty, mixed $value): \stdClass
    {
        if (\array_key_exists($activeProperty, $activeContext->termDefinitions)) {
            /** @var TermDefinition $definition */
            $definition = $activeContext->termDefinitions[$activeProperty];

            // 1
            if (
                Keyword::ID->value === $definition->typeMapping
                && \is_string($value)
            ) {
                return (object) [Keyword::ID->value => IriResolver::expand($activeContext, $value, true, false)];
            }

            // 2
            if (
                Keyword::VOCAB->value === $definition->typeMapping
                && \is_string($value)
            ) {
                return (object) [Keyword::ID->value => IriResolver::expand($activeContext, $value, true)];
            }
        }

        // 3
        $result = [Keyword::VALUE->value => $value];

        // 4
        if (
            isset($definition)
            && $definition->typeMapping
            && !\in_array($definition->typeMapping, [Keyword::ID->value, Keyword::VOCAB->value, Keyword::NONE->value], true)
        ) {
            $result[Keyword::TYPE->value] = $definition->typeMapping;
        // 5
        } elseif (\is_string($value)) {
            // 5.1
            if (isset($definition) && false !== $definition->languageMapping) {
                $language = $definition->languageMapping;
            } else {
                $language = $activeContext->defaultLangage;
            }

            // 5.3
            if (null !== $language) {
                $result[Keyword::LANGUAGE->value] = $language;
            }

            // 5.2
            if (isset($definition) && false !== $definition->directionMapping) {
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

    /**
     * @param TermDefinition[] $activeDefinitions
     */
    private function processElementEntries(
        mixed $element,
        Context $activeContext,
        array|\stdClass &$result,
        array &$nests,
        ?string $activeProperty,
        ProcessorOptions $options,
        Context $typeScopedContext,
        ?string $baseUrl,
        array $inputType,
        array $activeDefinitions,
    ): void {
        $nests = [];

        $arrayElement = (array) $element;
        ksort($arrayElement);

        foreach ($arrayElement as $key => $value) {
            // 13.1
            if (Keyword::CONTEXT->value === $key) {
                continue;
            }

            // 13.2
            $expandedProperty = IriResolver::expand($activeContext, $key);

            // The framing flag keywords expand to themselves; the generic IRI
            // expansion returns null for them because they merely have the form
            // of a keyword.
            $isFramingFlagKeyword = null === $expandedProperty && \in_array($key, [
                FramingKeyword::DEFAULT->value,
                FramingKeyword::EMBED->value,
                FramingKeyword::EXPLICIT->value,
                FramingKeyword::OMIT_DEFAULT->value,
                FramingKeyword::REQUIRE_ALL->value,
            ], true);

            if ($isFramingFlagKeyword) {
                // 13.4.2 of the recommendation: framing keywords are dropped
                // outside of frame expansion.
                if (!$options->frameExpansion) {
                    continue;
                }

                $expandedProperty = $key;
            }

            // 13.3
            if (!$expandedProperty || (!str_contains($expandedProperty, ':') && !Keyword::tryFrom($expandedProperty) && !$isFramingFlagKeyword)) {
                continue;
            }

            // 13.4
            if (Keyword::tryFrom($expandedProperty) || $isFramingFlagKeyword) {
                // 13.4.1
                if (Keyword::REVERSE->value === $activeProperty) {
                    throw new ExpansionException('invalid reverse property map');
                }

                $result = (array) $result;
                $expandedValue = [];

                // 13.4.2
                if (
                    \array_key_exists($expandedProperty, $result)
                    && $expandedProperty !== Keyword::INCLUDED->value
                    && $expandedProperty !== Keyword::TYPE->value
                    && Context::PROCESSING_MODE_10 !== $activeContext->processingMode
                ) {
                    throw new ExpansionException('colliding keywords');
                }

                switch ($expandedProperty) {
                    case Keyword::ID->value:
                        // 13.4.3
                        $expandedValue = $this->processIdKeyword($activeContext, $value, $options, $expandedValue);

                        break;
                    case Keyword::TYPE->value:
                        // 13.4.4
                        $expandedValue = $this->processTypeKeyword($typeScopedContext, $result, $value, $options, $expandedValue);

                        break;
                    case Keyword::GRAPH->value:
                        // 13.4.5
                        $expandedValue = $this->processGraphKeyword($activeContext, $value, $baseUrl, $options, $expandedValue);

                        break;
                    case Keyword::INCLUDED->value:
                        // 13.4.6
                        $expandedValue = $this->processIncludedKeyword($activeContext, $value, $result, $baseUrl, $options, $expandedValue);

                        break;
                    case Keyword::VALUE->value:
                        // 13.4.7
                        $expandedValue = $this->processValueKeyword($activeContext, $value, $result, $inputType, $options, $expandedValue);

                        break;
                    case Keyword::LANGUAGE->value:
                        // 13.4.8
                        $expandedValue = $this->processLanguageKeyword($value, $options);

                        break;
                    case Keyword::DIRECTION->value:
                        // 13.4.9
                        $expandedValue = $this->processDirectionKeyword($activeContext, $value, $options);

                        break;
                    case Keyword::INDEX->value:
                        // 13.4.10
                        $expandedValue = $this->processIndexKeyword($value);

                        break;
                    case Keyword::LIST->value:
                        // 13.4.11
                        $expandedValue = $this->processListKeyword($activeContext, $activeProperty, $value, $baseUrl, $options, $expandedValue);

                        break;
                    case Keyword::SET->value:
                        // 13.4.12
                        $expandedValue = $this->doExpand(
                            $value,
                            $options,
                            $baseUrl,
                            $activeContext,
                            $activeProperty,
                        );

                        break;
                    case Keyword::REVERSE->value:
                        // 13.4.13
                        $expandedValue = $this->processReverseKeyword($activeContext, $value, $result, $expandedProperty, $baseUrl, $options);

                        // 13.4.13.5
                        continue 2;
                    case Keyword::NEST->value:
                        // 13.4.14
                        $nests[] = $key ?: [];

                        continue 2;
                }

                // 13.4.15: only the five framing flag keywords are re-expanded here;
                // the core keywords were already handled above.
                if ($options->frameExpansion) {
                    $framingFlagKeywords = [
                        FramingKeyword::DEFAULT->value,
                        FramingKeyword::EMBED->value,
                        FramingKeyword::EXPLICIT->value,
                        FramingKeyword::OMIT_DEFAULT->value,
                        FramingKeyword::REQUIRE_ALL->value,
                    ];

                    if (\in_array($expandedProperty, $framingFlagKeywords, true)) {
                        $expandedValue = $this->doExpand(
                            $value,
                            $options,
                            $baseUrl,
                            $activeContext,
                            $expandedProperty,
                        );
                    }
                }

                // 13.4.16
                if (
                    null !== $expandedValue
                    || Keyword::VALUE->value !== $expandedProperty
                    || !\in_array(Keyword::JSON->value, $inputType, true)
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
                null !== $keyDefinition
                && Keyword::JSON->value === $keyDefinition->typeMapping
            ) {
                $expandedValue = $this->processJsonTypeMapping($value);
            // 13.7
            } elseif (
                $containerMapping
                && null !== $keyDefinition
                && \in_array(Keyword::LANGUAGE->value, $containerMapping, true)
                && \is_object($value)
            ) {
                $expandedValue = $this->processLanguageContainerMapping($activeContext, $keyDefinition, $value);
            // 13.8
            } elseif (
                \is_object($value)
                && $containerMapping
                && null !== $keyDefinition
                && \count(array_intersect($containerMapping, [
                    Keyword::INDEX->value, Keyword::TYPE->value, Keyword::ID->value,
                ]))
            ) {
                $expandedValue = $this->processContainerMapping(
                    $activeContext,
                    $keyDefinition,
                    $key,
                    $value,
                    $containerMapping,
                    $baseUrl,
                    $options,
                );
            } else {
                // 13.9
                $expandedValue = $this->doExpand(
                    $value,
                    $options,
                    $baseUrl,
                    $activeContext,
                    $key,
                );
            }

            // 13.10
            if (null === $expandedValue) {
                continue;
            }

            // 13.11
            if (
                $containerMapping
                && \in_array(Keyword::LIST->value, $containerMapping, true)
                && !$this->isListObject($expandedValue)
                && !$this->isListObject($value)
            ) {
                if (\is_array($expandedValue)) {
                    foreach ($expandedValue as $expandedEntry) {
                        if (
                            Context::PROCESSING_MODE_10 === $activeContext->processingMode
                            && $this->isListObject($expandedEntry)
                        ) {
                            throw new ExpansionException('list of lists');
                        }
                    }
                }

                if (!\is_array($expandedValue)) {
                    $expandedValue = [$expandedValue];
                }

                $expandedValue = (object) [Keyword::LIST->value => $expandedValue];
            }

            // 13.12
            if (
                $containerMapping
                && \in_array(Keyword::GRAPH->value, $containerMapping, true)
                && !\in_array(Keyword::ID->value, $containerMapping, true)
                && !\in_array(Keyword::INDEX->value, $containerMapping, true)
            ) {
                $graphExpandedValue = [];

                // 13.12.1
                foreach ((array) $expandedValue as $key => $expandedEntry) {
                    $graphExpandedValue[] = (object) [Keyword::GRAPH->value => [(object) $expandedEntry]];
                }

                $expandedValue = $graphExpandedValue;
            }

            $result = (array) $result;

            // 13.13
            if (\array_key_exists($key, $activeDefinitions) && $activeDefinitions[$key]->reverseProperty) {
                $this->processReverseProperty($result, $expandedProperty, $expandedValue);
            } else {
                // 13.14
                $result = ValueAdder::addValue($expandedValue, $expandedProperty, $result, true);
            }
        }
    }

    private function processIdKeyword(
        Context $activeContext,
        mixed $value,
        ProcessorOptions $options,
        array $expandedValue,
    ): array|string|null {
        // 13.4.3.1
        if (!\is_string($value) && !$options->frameExpansion) {
            throw new ExpansionException('invalid @id value');
        }

        // 13.4.3.2
        if ($options->frameExpansion) {
            $valueEntries = $value instanceof \stdClass ? [$value] : (array) $value;

            foreach ($valueEntries as $valueEntry) {
                // An empty map is the wildcard @id pattern and is kept as is.
                $expandedValue[] = $valueEntry instanceof \stdClass
                    ? $valueEntry
                    : IriResolver::expand($activeContext, $valueEntry, true, false);
            }
        } else {
            $expandedValue = IriResolver::expand($activeContext, $value, true, false);
        }

        return $expandedValue;
    }

    private function processTypeKeyword(
        Context $typeScopedContext,
        array &$result,
        mixed $value,
        ProcessorOptions $options,
        array $expandedValue,
    ): mixed {
        // 13.4.4.1
        $this->validateValueForType($value, $options);

        // 13.4.4.2
        if (\is_object($value) && !\count(get_object_vars($value))) {
            $expandedValue = $value;
        // 13.4.4.3
        } elseif (\is_object($value) && property_exists($value, FramingKeyword::DEFAULT->value)) {
            $expandedValue = new \stdClass();
            $expandedValue->{FramingKeyword::DEFAULT->value} = IriResolver::expand(
                $typeScopedContext,
                $value->{FramingKeyword::DEFAULT->value},
                true,
            );
        // 13.4.4.4
        } else {
            foreach ((array) $value as $valueEntry) {
                $expandedValue[] = IriResolver::expand($typeScopedContext, $valueEntry, true);
            }
        }

        // 13.4.4.5
        if (\array_key_exists(Keyword::TYPE->value, $result) && \is_array($expandedValue)) {
            if (\is_array($result[Keyword::TYPE->value])) {
                $expandedValue = [...$result[Keyword::TYPE->value], ...$expandedValue];
            } else {
                $expandedValue = [$result[Keyword::TYPE->value], ...$expandedValue];
            }

            sort($expandedValue);
        }

        if (\is_array($expandedValue) && 1 === \count($expandedValue)) {
            $expandedValue = $expandedValue[0];
        }

        return $expandedValue;
    }

    private function processGraphKeyword(
        Context $activeContext,
        mixed $value,
        ?string $baseUrl,
        ProcessorOptions $options,
        array $expandedValue,
    ): array {
        $expandedValue = $this->doExpand(
            $value,
            $options,
            $baseUrl,
            $activeContext,
            Keyword::GRAPH->value,
        );

        if (!\is_array($expandedValue)) {
            $expandedValue = (array) $expandedValue;
        }

        foreach ($expandedValue as $valueEntry) {
            if (!\is_object($valueEntry)) {
                $valueEntry = (object) $valueEntry;
            }
        }

        return $expandedValue;
    }

    private function processIncludedKeyword(
        Context $activeContext,
        mixed $value,
        array &$result,
        ?string $baseUrl,
        ProcessorOptions $options,
        array $expandedValue,
    ): array {
        // 13.4.6.1
        if (Context::PROCESSING_MODE_11 === $activeContext->processingMode) {
            // This is not in the specs but the in08-in.jsonld test explicitely say that a value/list object @included is invalid
            if ($this->isValueObject($value) || $this->isListObject($value)) {
                throw new ExpansionException('invalid @included value');
            }

            // 13.4.6.2
            $expandedValue = $this->doExpand(
                element: $value,
                options: $options,
                baseUrl: $baseUrl,
                activeContext: $activeContext,
                activeProperty: null,
            );

            $expandedValue = \is_array($expandedValue) ? $expandedValue : [$expandedValue];

            // 13.4.6.3
            foreach ($expandedValue as $expandedElement) {
                if (!$this->isNodeObject($expandedElement)) {
                    throw new ExpansionException('invalid @included value');
                }
            }

            // 13.4.6.4
            if (\array_key_exists(Keyword::INCLUDED->value, $result)) {
                $expandedValue = [...$result[Keyword::INCLUDED->value], ...$expandedValue];
            }
        }

        return $expandedValue;
    }

    private function processValueKeyword(
        Context $activeContext,
        mixed $value,
        array &$result,
        array $inputType,
        ProcessorOptions $options,
        array $expandedValue,
    ): mixed {
        // 13.4.7.1
        if (\in_array(Keyword::JSON->value, $inputType, true)) {
            $expandedValue = $value;

            if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                throw new ExpansionException('invalid term definition');
            }
        } else {
            // 13.4.7.2
            $this->validateValueForValue($value, $options);

            // 13.4.7.3
            $expandedValue = $value;
        }

        // 13.4.7.4
        if (null === $expandedValue) {
            $result[Keyword::VALUE->value] = null;
        }

        return $expandedValue;
    }

    private function processLanguageKeyword(mixed $value, ProcessorOptions $options): mixed
    {
        // 13.4.8.1
        $this->validateValueForLanguage($value, $options);

        // 13.4.8.2: language tags are processed case-insensitively; processors
        // normalize them to lowercase.
        if (\is_string($value)) {
            $value = strtolower($value);
        }

        return $options->frameExpansion ? ($value instanceof \stdClass ? [$value] : (array) $value) : $value;
    }

    private function processDirectionKeyword(Context $activeContext, mixed $value, ProcessorOptions $options): mixed
    {
        // 13.4.9.1
        if (Context::PROCESSING_MODE_11 === $activeContext->processingMode) {
            // 13.4.9.2
            if (!\in_array($value, ['ltr', 'rtl'], true)) {
                throw new ExpansionException('invalid base direction');
            }
        }

        // 13.4.9
        return $options->frameExpansion ? ($value instanceof \stdClass ? [$value] : (array) $value) : $value;
    }

    private function processIndexKeyword(mixed $value): string
    {
        // 13.4.10.1
        if (!\is_string($value)) {
            throw new ExpansionException('invalid @index value');
        }

        // 13.4.10.2
        return $value;
    }

    private function processListKeyword(
        Context $activeContext,
        ?string $activeProperty,
        mixed $value,
        ?string $baseUrl,
        ProcessorOptions $options,
        array $expandedValue,
    ): array {
        // 13.4.11.1
        if (null !== $activeProperty && Keyword::GRAPH->value !== $activeProperty) {
            // 13.4.11.2
            $expandedValue = $this->doExpand(
                $value,
                $options,
                $baseUrl,
                $activeContext,
                $activeProperty,
            );

            if (!\is_array($expandedValue)) {
                $expandedValue = [$expandedValue];
            }

            foreach ($expandedValue as $expandedEntry) {
                if (
                    Context::PROCESSING_MODE_10 === $activeContext->processingMode
                    && $this->isListObject($expandedEntry)
                ) {
                    throw new ExpansionException('list of lists');
                }
            }
        }

        return $expandedValue;
    }

    private function processReverseKeyword(
        Context $activeContext,
        mixed $value,
        mixed &$result,
        ?string $expandedProperty,
        ?string $baseUrl,
        ProcessorOptions $options,
    ): mixed {
        // 13.4.13.1
        if (!\is_object($value)) {
            throw new ExpansionException('invalid @reverse value');
        }

        // 13.4.13.2
        $expandedValue = $this->doExpand(
            $value,
            $options,
            $baseUrl,
            $activeContext,
            Keyword::REVERSE->value,
        );

        if (\is_array($expandedValue)) {
            $expandedValue = $expandedValue[0];
        }

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
                foreach ($items as $item) {
                    // 13.4.13.4.2.1.1
                    if ($this->isValueObject($item) || $this->isListObject($item)) {
                        throw new ExpansionException('invalid @reverse property value');
                    }

                    // 13.4.13.4.2.1.2
                    $reverseMap = ValueAdder::addValue($item, $property, $reverseMap, true);
                }
            }

            $result[$expandedProperty] = $reverseMap;
        }

        return $expandedValue;
    }

    private function processJsonTypeMapping(mixed $value): \stdClass
    {
        $expandedValue = new \stdClass();
        $expandedValue->{Keyword::VALUE->value} = $value;
        $expandedValue->{Keyword::TYPE->value} = Keyword::JSON->value;

        return $expandedValue;
    }

    private function processLanguageContainerMapping(
        Context $activeContext,
        TermDefinition $keyDefinition,
        mixed $value,
    ): array {
        // 13.7.1
        $expandedValue = [];

        // 13.7.2
        $direction = $activeContext->defaultBaseDirection;

        // 13.7.3
        if (false !== $keyDefinition->directionMapping) {
            $direction = $keyDefinition->directionMapping;
        }

        $arrayValue = (array) $value;
        ksort($arrayValue);

        // 13.7.4
        foreach ($arrayValue as $language => $languageValue) {
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
                    throw new ExpansionException('invalid language map value');
                }

                // 13.7.4.2.3
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

        return $expandedValue;
    }

    private function processContainerMapping(
        Context $activeContext,
        TermDefinition $keyDefinition,
        string $key,
        mixed $value,
        array $containerMapping,
        ?string $baseUrl,
        ProcessorOptions $options,
    ): array {
        // 13.8.1
        $expandedValue = [];

        // 13.8.2
        $indexKey = $keyDefinition->indexMapping ?: Keyword::INDEX->value;

        $arrayValue = (array) $value;
        ksort($arrayValue);

        // 13.8.3
        foreach ($arrayValue as $index => $indexValue) {
            // 13.8.3.1
            if (\in_array(Keyword::ID->value, $containerMapping, true) || \in_array(Keyword::TYPE->value, $containerMapping, true)) {
                $mapContext = $activeContext->previousContext ?: $activeContext;
            } else {
                $mapContext = $activeContext;
            }

            // 13.8.3.2
            if (
                \in_array(Keyword::TYPE->value, $containerMapping, true)
                && \array_key_exists($index, $mapContext->termDefinitions)
                && false !== $mapContext->termDefinitions[$index]->context
            ) {
                $mapContext = $this->contextProcessor->processContext(
                    $mapContext,
                    $mapContext->termDefinitions[$index]->context,
                    $mapContext->termDefinitions[$index]->baseUrl,
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
            $indexValue = $this->doExpand(
                $indexValue,
                $options,
                $baseUrl,
                $mapContext,
                $key,
                true,
            );

            if (!\is_array($indexValue)) {
                $indexValue = (array) $indexValue;
            }

            // 13.8.3.7
            foreach ($indexValue as $item) {
                // 13.8.3.7.1
                if (\in_array(Keyword::GRAPH->value, $containerMapping, true) && !$this->isGraphObject($item)) {
                    $item = (object) [Keyword::GRAPH->value => [$item]];
                }

                // 13.8.3.7.2
                if (
                    \in_array(Keyword::INDEX->value, $containerMapping, true)
                    && Keyword::INDEX->value !== $indexKey
                    && Keyword::NONE->value !== $expandedIndex
                ) {
                    // 13.8.3.7.2.1
                    $reExpandedIndex = $this->expandValue($activeContext, $indexKey, $index);

                    // 13.8.3.7.2.2
                    $expandedIndexKey = IriResolver::expand($activeContext, $indexKey);

                    // 13.8.3.7.2.3
                    $indexPropertyValues = [$reExpandedIndex];

                    if (null !== $expandedIndexKey && property_exists($item, $expandedIndexKey)) {
                        $indexPropertyValues[] = $item->$expandedIndexKey[0];
                    }

                    // 13.8.3.7.2.4
                    $item->$expandedIndexKey = $indexPropertyValues;

                    // 13.8.3.7.2.5
                    if ($this->isValueObject($item)) {
                        if (1 < \count(get_object_vars($item))) {
                            throw new ExpansionException('invalid value object');
                        }
                    }
                } elseif (
                    // 13.8.3.7.3
                    \in_array(Keyword::INDEX->value, $containerMapping, true)
                    && !property_exists($item, Keyword::INDEX->value)
                    && Keyword::NONE->value !== $expandedIndex
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
                    \in_array(Keyword::ID->value, $containerMapping, true)
                    && !property_exists($item, Keyword::ID->value)
                    && Keyword::NONE->value !== $expandedIndex
                ) {
                    $expandedIndex = IriResolver::expand($activeContext, $index, true, false);
                    $item->{Keyword::ID->value} = $expandedIndex;
                } elseif (
                    // 13.8.3.7.5
                    \in_array(Keyword::TYPE->value, $containerMapping, true)
                    && Keyword::NONE->value !== $expandedIndex
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

        return $expandedValue;
    }

    private function processReverseProperty(
        array &$result,
        string $expandedProperty,
        \stdClass|array $expandedValue,
    ): void {
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
                throw new ExpansionException('invalid reverse property value');
            }

            // 13.13.4.2
            if (!property_exists($reverseMap, $expandedProperty)) {
                $reverseMap->$expandedProperty = [];
            }

            // 13.13.4.3
            ValueAdder::addValue($item, $expandedProperty, $reverseMap, true);
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
        ?string $baseUrl,
        array $inputType,
        array $activeDefinitions,
    ): void {
        foreach ($nests as $nestingKey) {
            $element = (array) $element;
            $nestContext = $activeContext;

            if (
                \array_key_exists($nestingKey, $activeDefinitions)
                && false !== $activeDefinitions[$nestingKey]->context
            ) {
                $nestContext = $this->contextProcessor->processContext(
                    $activeContext,
                    $activeDefinitions[$nestingKey]->context,
                    $activeDefinitions[$nestingKey]->baseUrl ?: $baseUrl,
                    overrideProtected: true,
                );
            }

            // 14.1
            $nestedValues = $element[$nestingKey];

            if (!\is_array($nestedValues)) {
                $nestedValues = [$nestedValues];
            }

            // 14.2
            foreach ($nestedValues as $nestedValue) {
                // 14.2.1
                if (!\is_object($nestedValue)) {
                    throw new ExpansionException('invalid @nest value');
                }

                // 14.2.1
                foreach ((array) $nestedValue as $key => $value) {
                    if (Keyword::VALUE->value === IriResolver::expand($activeContext, $key)) {
                        throw new ExpansionException('invalid @nest value');
                    }
                }

                // 14.2.2
                $this->processElementEntries(
                    $nestedValue,
                    $nestContext,
                    $result,
                    $nests,
                    $activeProperty,
                    $options,
                    $typeScopedContext,
                    $baseUrl,
                    $inputType,
                    $nestContext->termDefinitions,
                );

                $this->processNestEntries(
                    $nestedValue,
                    $nestContext,
                    $result,
                    $nests,
                    $activeProperty,
                    $options,
                    $typeScopedContext,
                    $baseUrl,
                    $inputType,
                    $nestContext->termDefinitions,
                );
            }
        }
    }

    private function handleScalarElement(
        Context $activeContext,
        int|float|string|bool $element,
        ?string $activeProperty,
        mixed $propertyScopedContext,
    ): ?\stdClass {
        // 4.1
        if (\in_array($activeProperty, [null, Keyword::GRAPH->value], true)) {
            return null;
        }

        // 4.2
        if (false !== $propertyScopedContext) {
            $activeContext = $this->contextProcessor->processContext(
                $activeContext,
                $propertyScopedContext,
                $activeContext->termDefinitions[$activeProperty]->baseUrl,
            );
        }

        // 4.3
        return $this->expandValue($activeContext, $activeProperty, $element);
    }

    private function handleArrayElement(
        Context $activeContext,
        array $element,
        ProcessorOptions $options,
        ?string $baseUrl,
        ?string $activeProperty,
        bool $fromMap,
    ): array {
        // 5.1
        $result = [];

        // 5.2
        foreach ($element as $item) {
            // 5.2.1
            $expandedItem = $this->doExpand(
                $item,
                $options,
                $baseUrl,
                $activeContext,
                $activeProperty,
                $fromMap,
            );

            // 5.2.2
            if (
                null !== $activeProperty
                && \array_key_exists($activeProperty, $activeContext->termDefinitions)
                && $activeContext->termDefinitions[$activeProperty]->containerMapping
                && \in_array(Keyword::LIST->value, $activeContext->termDefinitions[$activeProperty]->containerMapping, true)
                && \is_array($expandedItem)
                && \is_array($item)
                && !$this->isListObject($item)
            ) {
                $expandedItem = (object) [Keyword::LIST->value => $expandedItem];
            }

            // 5.2.3
            if (\is_array($expandedItem) && !\is_array($item)) {
                $result = [...$result, ...$expandedItem];
            } elseif (null !== $expandedItem) {
                $result[] = $expandedItem;
            }
        }

        // 5.3
        return $result;
    }

    private function handlePreviousContext(Context $activeContext, \stdClass $element, bool $fromMap): Context
    {
        if (!$fromMap) {
            $switchToPreviousContext = true;

            if (
                1 === \count(get_object_vars($element))
                && Keyword::ID->value === IriResolver::expand($activeContext, array_keys(get_object_vars($element))[0])
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

            if (null === $activeContext) {
                throw new ExpansionException('Invalid previous context');
            }
        }

        return $activeContext;
    }

    private function handleTypeEntries(Context &$activeContext, \stdClass $element, Context $typeScopedContext, array &$inputType, ProcessorOptions $options): void
    {
        foreach ($element as $key => $value) {
            if (Keyword::TYPE->value !== IriResolver::expand($activeContext, $key)) {
                continue;
            }

            // A frame may use an empty map (wildcard) or an empty array (match none)
            // as the @type entry: there is then no type-scoped context to select.
            if ($options->frameExpansion && ($value instanceof \stdClass || [] === $value)) {
                continue;
            }

            // 11.1
            $arrayValue = (array) $value;
            $lastArrayValueKey = array_key_last($arrayValue);

            if (null === $lastArrayValueKey) {
                throw new ExpansionException('Invalid @type entry.');
            }

            // 12 : we do 12 here, so we don't loop twice over $element
            $inputType = [
                IriResolver::expand($activeContext, $key) => IriResolver::expand($activeContext, $arrayValue[$lastArrayValueKey]),
            ];

            sort($arrayValue);

            // 11.2
            foreach ($arrayValue as $term) {
                if (
                    \is_string($term)
                    && \array_key_exists($term, $typeScopedContext->termDefinitions)
                    && false !== $typeScopedContext->termDefinitions[$term]->context
                ) {
                    $activeContext = $this->contextProcessor->processContext(
                        $activeContext,
                        $typeScopedContext->termDefinitions[$term]->context,
                        $typeScopedContext->termDefinitions[$term]->baseUrl,
                        propagate: false,
                    );
                }
            }
        }
    }

    private function handleResultValueEntry(\stdClass $result, ProcessorOptions $options): bool
    {
        // 15.1
        $this->validateResultValue($result);

        // In frame expansion, @value, @language and @type entries may hold empty
        // maps (wildcards) or arrays of values, which relaxes the checks below.
        $valueIsFramePattern = $options->frameExpansion
            && ($result->{Keyword::VALUE->value} instanceof \stdClass || \is_array($result->{Keyword::VALUE->value}));

        // 15.2
        if (property_exists($result, Keyword::TYPE->value) && Keyword::JSON->value === $result->{Keyword::TYPE->value}) {
            // 15.3
        } elseif (!$valueIsFramePattern && (null === $result->{Keyword::VALUE->value} || [] === $result->{Keyword::VALUE->value})) {
            return false;
        // 15.4
        } elseif (!$valueIsFramePattern && !\is_string($result->{Keyword::VALUE->value}) && property_exists($result, Keyword::LANGUAGE->value)) {
            throw new ExpansionException('invalid language-tagged value');
        // 15.5
        } elseif (
            property_exists($result, Keyword::TYPE->value)
            && !IriResolver::isAbsoluteIri($result->{Keyword::TYPE->value})
            && !($options->frameExpansion && ($result->{Keyword::TYPE->value} instanceof \stdClass || \is_array($result->{Keyword::TYPE->value})))
        ) {
            throw new ExpansionException('invalid typed value');
        }

        return true;
    }

    private function handleResultSetAndListEntries(\stdClass &$result): void
    {
        // 17.1
        if (2 < \count(get_object_vars($result))) {
            throw new ExpansionException('invalid set or list object');
        }

        // 17.1
        if (2 === \count(get_object_vars($result)) && !property_exists($result, Keyword::INDEX->value)) {
            throw new ExpansionException('invalid set or list object');
        }

        // 17.2
        if (property_exists($result, Keyword::SET->value)) {
            $result = $result->{Keyword::SET->value};
        }
    }

    private function handleNullPropertyAndGraphProperty(\stdClass|array &$result, ProcessorOptions $options): bool
    {
        // Frames keep their free-floating nodes: a frame reduced to a bare @id, a
        // lone framing flag, or an empty wildcard map is meaningful for matching.
        if ($options->frameExpansion) {
            return false;
        }

        // 19.1
        if (\is_object($result)) {
            $objectPropertiesCount = \count(get_object_vars($result));

            if (0 === $objectPropertiesCount) {
                return true;
            }

            if (property_exists($result, Keyword::VALUE->value) || property_exists($result, Keyword::LIST->value)) {
                return true;
            }

            // 19.2
            if (1 === $objectPropertiesCount && property_exists($result, Keyword::ID->value)) {
                return true;
            }
        }

        return false;
    }

    // 13.4.4.1
    private function validateValueForType(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion && \is_object($value)) {
            if ($value instanceof \stdClass && [] === get_object_vars($value)) {
                return true;
            }

            if (
                property_exists($value, FramingKeyword::DEFAULT->value)
                && IriResolver::isIri($value->{FramingKeyword::DEFAULT->value})
            ) {
                return true;
            }
        }

        if (\is_array($value)) {
            foreach ($value as $valueEntry) {
                if (!\is_string($valueEntry)) {
                    throw new ExpansionException('invalid type value');
                }
            }

            return true;
        }

        if (\is_string($value)) {
            return true;
        }

        throw new ExpansionException('invalid type value');
    }

    // 13.4.7.2
    private function validateValueForValue(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion) {
            if ($value instanceof \stdClass && [] === get_object_vars($value)) {
                return true;
            }

            if (\is_array($value)) {
                foreach ($value as $valueEntry) {
                    if (!\is_scalar($valueEntry)) {
                        throw new ExpansionException('invalid type value');
                    }
                }

                return true;
            }
        }

        if (\is_scalar($value) || null === $value) {
            return true;
        }

        throw new ExpansionException('invalid value object value');
    }

    // 13.4.8.1
    private function validateValueForLanguage(mixed $value, ProcessorOptions $options): bool
    {
        if ($options->frameExpansion) {
            if ($value instanceof \stdClass && [] === get_object_vars($value)) {
                return true;
            }

            if (\is_array($value)) {
                foreach ($value as $valueEntry) {
                    if (!\is_string($valueEntry)) {
                        throw new ExpansionException('invalid type value');
                    }
                }

                return true;
            }
        }

        if (\is_string($value)) {
            return true;
        }

        throw new ExpansionException('invalid language-tagged string');
    }

    private function validateResultValue(\stdClass $result): bool
    {
        if (
            (property_exists($result, Keyword::LANGUAGE->value) || property_exists($result, Keyword::DIRECTION->value))
            && property_exists($result, Keyword::TYPE->value)
        ) {
            throw new ExpansionException('invalid value object');
        }

        foreach ($result as $resultKey => $resultEntry) {
            if (!\in_array(
                $resultKey,
                [Keyword::DIRECTION->value, Keyword::INDEX->value, Keyword::LANGUAGE->value, Keyword::TYPE->value, Keyword::VALUE->value],
                true,
            )) {
                throw new ExpansionException('invalid value object');
            }
        }

        return true;
    }

    private function isGraphObject(mixed $object): bool
    {
        return \is_object($object) && property_exists($object, Keyword::GRAPH->value);
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
            return 2 === \count(get_object_vars($object));
        }

        return 1 === \count(get_object_vars($object));
    }

    private function isNodeObject(mixed $object): bool
    {
        if (!\is_object($object)) {
            return false;
        }

        if (
            property_exists($object, Keyword::VALUE->value)
            || property_exists($object, Keyword::LIST->value)
            || property_exists($object, Keyword::SET->value)
        ) {
            return false;
        }

        if (
            2 === \count(get_object_vars($object))
            && property_exists($object, Keyword::GRAPH->value)
            && property_exists($object, Keyword::CONTEXT->value)
        ) {
            return false;
        }

        return true;
    }
}
