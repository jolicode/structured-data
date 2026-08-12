<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Frame;

use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextCache;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\NodeMapGenerator;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\IdentifierGenerator;

/**
 * This is a PHP implementation of the Framing algorithm based on the JSON-LD 1.1
 * Framing W3C Recommendation published on July 16th, 2020.
 *
 * @see https://www.w3.org/TR/json-ld11-framing/#framing-algorithm
 */
class Framer
{
    private const DEFAULT_FLAGS = [
        'embed' => '@once',
        'explicit' => false,
        'requireAll' => false,
        'omitDefault' => false,
    ];

    /**
     * @var array<string, array<string, array{parent: mixed, property: ?string}>>
     */
    private array $uniqueEmbeds = [];

    /**
     * @var array<string, array<string, array<string, mixed>>>
     */
    private array $graphMap = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    private array $subjects = [];

    /**
     * @var array<int, array{subject: array<string, mixed>, graph: string}>
     */
    private array $subjectStack = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    private array $link = [];

    /**
     * Counts how many times each blank node identifier appears in the output.
     *
     * @var array<string, int>
     */
    private array $bnodeMap = [];

    private string $graph = FramingKeyword::DEFAULT->value;

    private bool $embedded = false;

    private bool $is11 = true;

    /**
     * @var array<string>
     */
    private array $bnodesToClear = [];

    /**
     * @var array<string, mixed>
     */
    private array $frameOptions = self::DEFAULT_FLAGS;

    private readonly ContextProcessor $contextProcessor;
    private readonly Expander $expander;
    private readonly Compactor $compactor;
    private readonly DocumentLoaderInterface $documentLoader;

    public function __construct(
        ?ContextProcessor $contextProcessor = null,
        ?Expander $expander = null,
        ?Compactor $compactor = null,
        ?DocumentLoaderInterface $documentLoader = null,
    ) {
        $this->documentLoader = $documentLoader ?? new HttpDocumentLoader();
        $this->contextProcessor = $contextProcessor ?? new ContextProcessor(new ContextCache($this->documentLoader));
        $this->expander = $expander ?? new Expander(documentLoader: $this->documentLoader);
        $this->compactor = $compactor ?? new Compactor(documentLoader: $this->documentLoader);
    }

    /**
     * Frames a JSON-LD document using another JSON-LD document as a frame.
     *
     * This is a PHP implementation of the frame() method of the JsonLdProcessor
     * interface described in the JSON-LD 1.1 Framing W3C Recommendation published
     * on July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld11-framing/#dom-jsonldprocessor-frame
     */
    public function frame(
        string|\stdClass $json,
        string|\stdClass $frame,
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

        $frameDocument = \is_string($frame) ? json_decode($frame) : $frame;

        if (!$frameDocument instanceof \stdClass && !\is_array($frameDocument)) {
            throw new JsonLdException('invalid frame');
        }

        $frameContext = $frameDocument instanceof \stdClass && property_exists($frameDocument, Keyword::CONTEXT->value)
            ? $frameDocument->{Keyword::CONTEXT->value}
            : new \stdClass();

        // The frame's context drives processing-mode-specific defaults.
        $activeContext = $this->contextProcessor->processContext(new Context(
            baseIri: $baseUrl,
            baseUrl: $baseUrl,
            processingMode: $options->processingMode,
        ), $frameContext, $baseUrl);

        $this->is11 = Context::PROCESSING_MODE_10 !== $activeContext->processingMode;
        $omitGraph = $options->omitGraph ?? $this->is11;
        $pruneBlankNodeIdentifiers = $this->is11;

        // Expand the input.
        if (\is_array($element)) {
            $element = (string) json_encode($element);
        }

        $expandedInput = $this->expander->expand($element, new ProcessorOptions(
            base: $baseUrl,
            expandContext: $options->expandContext,
            processingMode: $options->processingMode,
            ordered: $options->ordered,
        ), encodeResult: false);

        // Expand the frame, using frame expansion rules.
        $frameToExpand = \is_array($frameDocument) ? (string) json_encode($frameDocument) : $frameDocument;
        $expandedFrame = $this->expander->expand($frameToExpand, new ProcessorOptions(
            base: $baseUrl,
            processingMode: $options->processingMode,
            frameExpansion: true,
            ordered: $options->ordered,
        ), encodeResult: false);

        // If the frame includes an entry expanding to @graph, the default graph is
        // framed; otherwise the merged graph is.
        $frameKeys = [];
        $frameEntries = $frameDocument instanceof \stdClass ? get_object_vars($frameDocument) : [];

        foreach (array_keys($frameEntries) as $key) {
            $frameKeys[] = IriResolver::expand($activeContext, (string) $key);
        }

        $merged = !\in_array(Keyword::GRAPH->value, $frameKeys, true);

        $framed = $this->frameMergedOrDefault(
            $expandedInput,
            self::asArrayData($expandedFrame),
            $merged,
            $pruneBlankNodeIdentifiers,
            $options,
        );

        $compacted = $this->compactor->compact(
            (string) json_encode($framed),
            $frameContext,
            $options,
            encodeResult: false,
            skipExpansion: true,
            forceGraph: !$omitGraph,
        );

        $compacted = $this->cleanupNull($compacted);

        if ($encodeResult) {
            return json_encode($compacted, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
        }

        return $compacted;
    }

    /**
     * Performs the framing on the default or merged graph and cleans the result up.
     *
     * @param array<int, array<string, mixed>> $expandedFrame
     *
     * @return array<int, array<string, mixed>>
     */
    private function frameMergedOrDefault(
        mixed $expandedInput,
        array $expandedFrame,
        bool $merged,
        bool $pruneBlankNodeIdentifiers,
        ProcessorOptions $options,
    ): array {
        $this->uniqueEmbeds = [];
        $this->subjectStack = [];
        $this->link = [];
        $this->bnodeMap = [];
        $this->bnodesToClear = [];
        $this->embedded = false;
        $this->graph = FramingKeyword::DEFAULT->value;
        $this->frameOptions = self::DEFAULT_FLAGS;
        $this->frameOptions['ordered'] = $options->ordered;

        // Build a map of all graphs, naming each blank node.
        $nodeMap = [FramingKeyword::DEFAULT->value => []];
        (new NodeMapGenerator(new IdentifierGenerator()))->buildNode($expandedInput, $nodeMap);

        /* @var array<string, array<string, array<string, mixed>>> $nodeMap */
        $this->graphMap = array_map(
            static fn (?array $graph): array => array_map(
                static fn (mixed $node): mixed => self::convertToArrays($node),
                $graph ?? [],
            ),
            $nodeMap,
        );

        if ($merged) {
            $this->graphMap['@merged'] = $this->mergeNodeMapGraphs($this->graphMap);
            $this->graph = '@merged';
        }

        $this->subjects = $this->graphMap[$this->graph];

        $framed = [];
        $subjectIds = array_keys($this->subjects);
        sort($subjectIds);
        $this->doFrame($subjectIds, $expandedFrame, $framed, null);

        if ($pruneBlankNodeIdentifiers) {
            // Blank nodes appearing only once do not need an identifier.
            $this->bnodesToClear = array_keys(
                array_filter($this->bnodeMap, static fn (int $usages): bool => 1 === $usages),
            );
        }

        $cleaned = $this->cleanupPreserve($framed);

        return \is_array($cleaned) ? $cleaned : [$cleaned];
    }

    /**
     * Frames the given subjects according to the given frame.
     *
     * @param array<string>                    $subjects
     * @param array<int, array<string, mixed>> $frame
     * @param array<mixed>|array<string,mixed> $parent
     */
    private function doFrame(array $subjects, array $frame, array &$parent, ?string $property): void
    {
        // Validate the frame.
        $this->validateFrame($frame);
        $frameObject = self::isEmptyMap($frame[0]) ? [] : $frame[0];

        // Get the flags for the current frame.
        $flags = [
            'embed' => $this->getFrameFlag($frameObject, 'embed'),
            'explicit' => $this->getFrameFlag($frameObject, 'explicit'),
            'requireAll' => $this->getFrameFlag($frameObject, 'requireAll'),
        ];

        if (!isset($this->link[$this->graph])) {
            $this->link[$this->graph] = [];
        }

        // Filter the subjects that match the frame.
        $matches = $this->filterSubjects($subjects, $frameObject, $flags);
        $matchedIds = array_keys($matches);
        sort($matchedIds);

        foreach ($matchedIds as $id) {
            $subject = $matches[$id];

            // Each top-level match is a compartmentalized result: the map of unique
            // embeds resets between them.
            if (null === $property) {
                $this->uniqueEmbeds = [$this->graph => []];
            } else {
                $this->uniqueEmbeds[$this->graph] ??= [];
            }

            if ('@link' === $flags['embed'] && isset($this->link[$this->graph][$id])) {
                self::addFrameOutput($parent, $property, $this->link[$this->graph][$id]);

                continue;
            }

            // Start the output for this subject.
            $output = [Keyword::ID->value => $id];

            if (str_starts_with($id, '_:')) {
                $this->bnodeMap[$id] = ($this->bnodeMap[$id] ?? 0) + 1;
            }

            $this->link[$this->graph][$id] = $output;

            // @first and @last are JSON-LD 1.0 constructs.
            if (\in_array($flags['embed'], ['@first', '@last'], true) && $this->is11) {
                throw new JsonLdException('invalid @embed value');
            }

            if (!$this->embedded && isset($this->uniqueEmbeds[$this->graph][$id])) {
                // This node object was already included in another node object.
                continue;
            }

            // If embedding would create a circular reference, or is forbidden, only
            // add a reference to the subject.
            if (
                $this->embedded
                && ('@never' === $flags['embed'] || $this->createsCircularReference($subject))
            ) {
                self::addFrameOutput($parent, $property, $output);

                continue;
            }

            // Embed the subject only once.
            if (
                $this->embedded
                && \in_array($flags['embed'], ['@first', '@once'], true)
                && isset($this->uniqueEmbeds[$this->graph][$id])
            ) {
                self::addFrameOutput($parent, $property, $output);

                continue;
            }

            // Only the last match is embedded.
            if ('@last' === $flags['embed'] && isset($this->uniqueEmbeds[$this->graph][$id])) {
                $this->removeEmbed($id);
            }

            $this->uniqueEmbeds[$this->graph][$id] = ['parent' => &$parent, 'property' => $property];

            // Push the matching subject onto the stack for circular embed checks.
            $this->subjectStack[] = ['subject' => $subject, 'graph' => $this->graph];

            // The subject may also be the name of a graph.
            if (isset($this->graphMap[$id])) {
                $recurse = false;
                $subframe = [[]];

                if (!\array_key_exists(Keyword::GRAPH->value, $frameObject)) {
                    $recurse = '@merged' !== $this->graph;
                } else {
                    $graphSubframe = $frameObject[Keyword::GRAPH->value][0] ?? [];
                    $subframe = [\is_array($graphSubframe) && !array_is_list($graphSubframe) ? $graphSubframe : []];
                    $recurse = !\in_array($id, ['@merged', FramingKeyword::DEFAULT->value], true);
                }

                if ($recurse) {
                    $this->frameInGraph($id, $subframe, $output);
                }
            }

            // If the frame has @included, recurse over its subframe.
            if (\array_key_exists(Keyword::INCLUDED->value, $frameObject)) {
                $this->frameEmbedded(false, $subjects, $frameObject[Keyword::INCLUDED->value], $output, Keyword::INCLUDED->value);
            }

            // Iterate over the subject properties.
            $subjectProperties = array_keys($subject);
            sort($subjectProperties);

            foreach ($subjectProperties as $subjectProperty) {
                // Keywords are copied to the output.
                if (Keyword::tryFrom($subjectProperty)) {
                    $output[$subjectProperty] = $subject[$subjectProperty];

                    if (Keyword::TYPE->value === $subjectProperty) {
                        foreach ($subject[Keyword::TYPE->value] as $type) {
                            if (\is_string($type) && str_starts_with($type, '_:')) {
                                $this->bnodeMap[$type] = ($this->bnodeMap[$type] ?? 0) + 1;
                            }
                        }
                    }

                    continue;
                }

                // With explicit inclusion, properties absent from the frame are skipped.
                if ($flags['explicit'] && !\array_key_exists($subjectProperty, $frameObject)) {
                    continue;
                }

                foreach ($subject[$subjectProperty] as $item) {
                    $subframe = \array_key_exists($subjectProperty, $frameObject)
                        ? $frameObject[$subjectProperty]
                        : $this->createImplicitFrame($flags);

                    if (\is_array($item) && \array_key_exists(Keyword::LIST->value, $item)) {
                        // Lists are framed item by item.
                        $firstSubframe = $frameObject[$subjectProperty][0] ?? null;
                        $listSubframe = \is_array($firstSubframe) && \array_key_exists(Keyword::LIST->value, $firstSubframe)
                            ? $firstSubframe[Keyword::LIST->value]
                            : $this->createImplicitFrame($flags);

                        $list = [Keyword::LIST->value => []];

                        foreach ($item[Keyword::LIST->value] as $listItem) {
                            if ($this->isSubjectReference($listItem)) {
                                $this->frameEmbedded(true, [$listItem[Keyword::ID->value]], $listSubframe, $list, Keyword::LIST->value);
                            } else {
                                self::addFrameOutput($list, Keyword::LIST->value, $listItem);
                            }
                        }

                        self::addFrameOutput($output, $subjectProperty, $list);
                    } elseif ($this->isSubjectReference($item)) {
                        $this->frameEmbedded(true, [$item[Keyword::ID->value]], $subframe, $output, $subjectProperty);
                    } elseif ($this->valueMatch($subframe[0] ?? [], $item)) {
                        self::addFrameOutput($output, $subjectProperty, $item);
                    }
                }
            }

            // Handle the default values of frame-only properties.
            $frameProperties = array_keys($frameObject);
            sort($frameProperties);

            foreach ($frameProperties as $frameProperty) {
                if (Keyword::TYPE->value === $frameProperty) {
                    // A default object on @type passes through; any other @type frame
                    // entry is only used for matching.
                    $typeFrame = $frameObject[Keyword::TYPE->value][0] ?? null;

                    if (!\is_array($typeFrame) || !\array_key_exists('@default', $typeFrame)) {
                        continue;
                    }
                } elseif (Keyword::tryFrom($frameProperty) || FramingKeyword::tryFrom($frameProperty)) {
                    continue;
                }

                $next = $frameObject[$frameProperty][0] ?? [];
                $omitDefaultOn = $this->getFrameFlag(\is_array($next) ? $next : [], 'omitDefault');

                if (!$omitDefaultOn && !\array_key_exists($frameProperty, $output)) {
                    $preserve = ['@null'];

                    if (\is_array($next) && \array_key_exists('@default', $next)) {
                        $preserve = \is_array($next['@default']) && array_is_list($next['@default'])
                            ? $next['@default']
                            : [$next['@default']];
                    }

                    $output[$frameProperty] = [['@preserve' => $preserve]];
                }
            }

            // Embed reverse values, finding the nodes referencing this subject.
            foreach (array_keys($frameObject[Keyword::REVERSE->value] ?? []) as $reverseProperty) {
                $subframe = $frameObject[Keyword::REVERSE->value][$reverseProperty];

                foreach ($this->subjects as $subjectName => $subjectNode) {
                    $nodeValues = $subjectNode[$reverseProperty] ?? [];

                    foreach ($nodeValues as $nodeValue) {
                        if (\is_array($nodeValue) && ($nodeValue[Keyword::ID->value] ?? null) === $id) {
                            $output[Keyword::REVERSE->value] ??= [];
                            $output[Keyword::REVERSE->value][$reverseProperty] ??= [];
                            $this->frameEmbedded(true, [$subjectName], $subframe, $output[Keyword::REVERSE->value][$reverseProperty], $property);

                            break;
                        }
                    }
                }
            }

            // Add the output to the parent.
            self::addFrameOutput($parent, $property, $output);

            array_pop($this->subjectStack);
        }
    }

    /**
     * Runs the framing algorithm recursively with an embedded state.
     *
     * @param array<string>                    $subjects
     * @param array<int, array<string, mixed>> $frame
     * @param array<mixed>                     $parent
     */
    private function frameEmbedded(bool $embedded, array $subjects, array $frame, array &$parent, ?string $property): void
    {
        $previousEmbedded = $this->embedded;
        $this->embedded = $embedded;
        $this->doFrame($subjects, $frame, $parent, $property);
        $this->embedded = $previousEmbedded;
    }

    /**
     * Recurses the framing algorithm into a named graph.
     *
     * @param array<int, array<string, mixed>> $subframe
     * @param array<mixed>                     $output
     */
    private function frameInGraph(string $graphName, array $subframe, array &$output): void
    {
        $previousGraph = $this->graph;
        $previousSubjects = $this->subjects;
        $previousEmbedded = $this->embedded;

        $this->graph = $graphName;
        $this->subjects = $this->graphMap[$graphName];
        $this->embedded = false;

        $subjectIds = array_keys($this->subjects);
        sort($subjectIds);
        $this->doFrame($subjectIds, $subframe, $output, Keyword::GRAPH->value);

        $this->graph = $previousGraph;
        $this->subjects = $previousSubjects;
        $this->embedded = $previousEmbedded;
    }

    /**
     * @param array<string, array<string, array<string, mixed>>> $graphMap
     *
     * @return array<string, array<string, mixed>>
     */
    private function mergeNodeMapGraphs(array $graphMap): array
    {
        $merged = [];

        foreach ($graphMap as $graph) {
            foreach ($graph as $id => $node) {
                $merged[$id] ??= [Keyword::ID->value => $id];

                foreach ($node as $nodeProperty => $values) {
                    if (Keyword::ID->value === $nodeProperty) {
                        continue;
                    }

                    if (Keyword::tryFrom((string) $nodeProperty) && Keyword::TYPE->value !== $nodeProperty) {
                        $merged[$id][$nodeProperty] = $values;

                        continue;
                    }

                    foreach ((array) $values as $value) {
                        if (!\in_array($value, $merged[$id][$nodeProperty] ?? [], true)) {
                            $merged[$id][$nodeProperty][] = $value;
                        }
                    }
                }
            }
        }

        return $merged;
    }

    /**
     * @param array<string>        $subjects
     * @param array<string, mixed> $frame
     * @param array<string, mixed> $flags
     *
     * @return array<string, array<string, mixed>>
     */
    private function filterSubjects(array $subjects, array $frame, array $flags): array
    {
        $matches = [];

        foreach ($subjects as $id) {
            $subject = $this->graphMap[$this->graph][$id] ?? null;

            if (null !== $subject && $this->filterSubject($subject, $frame, $flags)) {
                $matches[$id] = $subject;
            }
        }

        return $matches;
    }

    /**
     * Returns true if the given subject matches the given frame, either on explicit.
     *
     * @id or @var inclusion, or by duck typing on the frame properties.
     *
     * @param array<string, mixed> $subject
     * @param array<string, mixed> $frame
     * @param array<string, mixed> $flags
     */
    private function filterSubject(array $subject, array $frame, array $flags): bool
    {
        $wildcard = true;
        $matchesSome = false;

        foreach ($frame as $key => $frameValues) {
            $matchThis = false;
            $nodeValues = $this->getValues($subject, (string) $key);
            $isEmpty = [] === (array) $frameValues;

            if (Keyword::ID->value === $key) {
                $frameIds = (array) $frameValues;

                if (self::isEmptyMap($frameIds[0] ?? null)) {
                    $matchThis = true;
                } else {
                    $matchThis = \in_array($nodeValues[0] ?? null, $frameIds, true);
                }

                if (!$flags['requireAll']) {
                    return $matchThis;
                }
            } elseif (Keyword::TYPE->value === $key) {
                $wildcard = false;
                $frameTypes = (array) $frameValues;

                if ($isEmpty) {
                    if (\count($nodeValues) > 0) {
                        return false;
                    }

                    $matchThis = true;
                } elseif (1 === \count($frameTypes) && self::isEmptyMap($frameTypes[0])) {
                    $matchThis = \count($nodeValues) > 0;
                } else {
                    foreach ($frameTypes as $type) {
                        if (\is_array($type) && \array_key_exists('@default', $type)) {
                            $matchThis = true;
                        } else {
                            $matchThis = $matchThis || \in_array($type, $nodeValues, true);
                        }
                    }
                }

                if (!$flags['requireAll']) {
                    return $matchThis;
                }
            } elseif (self::isKeywordString((string) $key)) {
                continue;
            } else {
                $thisFrame = ((array) $frameValues)[0] ?? null;
                $hasDefault = false;

                if (null !== $thisFrame) {
                    $this->validateFrame([$thisFrame]);
                    $hasDefault = \is_array($thisFrame) && \array_key_exists('@default', $thisFrame);
                }

                // No longer a wildcard pattern once the frame has any non-keyword property.
                $wildcard = false;

                // A node without a value matches when the frame provides a default.
                if ([] === $nodeValues && $hasDefault) {
                    continue;
                }

                // A match-none frame value forbids any node value.
                if (\count($nodeValues) > 0 && $isEmpty) {
                    return false;
                }

                if (null === $thisFrame) {
                    $matchThis = [] === $nodeValues;
                } elseif (\is_array($thisFrame) && \array_key_exists(Keyword::LIST->value, $thisFrame)) {
                    $listValue = $thisFrame[Keyword::LIST->value][0] ?? null;
                    $nodeList = $nodeValues[0][Keyword::LIST->value] ?? null;

                    if (\is_array($listValue) && \is_array($nodeList)) {
                        if (\array_key_exists(Keyword::VALUE->value, $listValue)) {
                            foreach ($nodeList as $listItem) {
                                if ($this->valueMatch($listValue, $listItem)) {
                                    $matchThis = true;

                                    break;
                                }
                            }
                        } else {
                            foreach ($nodeList as $listItem) {
                                if ($this->nodeMatch($listValue, $listItem, $flags)) {
                                    $matchThis = true;

                                    break;
                                }
                            }
                        }
                    }
                } elseif (\is_array($thisFrame) && \array_key_exists(Keyword::VALUE->value, $thisFrame)) {
                    foreach ($nodeValues as $nodeValue) {
                        if ($this->valueMatch($thisFrame, $nodeValue)) {
                            $matchThis = true;

                            break;
                        }
                    }
                } elseif ($this->isSubjectReference($thisFrame)) {
                    foreach ($nodeValues as $nodeValue) {
                        if ($this->nodeMatch($thisFrame, $nodeValue, $flags)) {
                            $matchThis = true;

                            break;
                        }
                    }
                } elseif (\is_array($thisFrame) || self::isEmptyMap($thisFrame)) {
                    $matchThis = \count($nodeValues) > 0;
                }
            }

            if (!$matchThis && $flags['requireAll']) {
                return false;
            }

            $matchesSome = $matchesSome || $matchThis;
        }

        return $wildcard || $matchesSome;
    }

    /**
     * @param array<string, mixed> $pattern
     * @param array<string, mixed> $flags
     */
    private function nodeMatch(array $pattern, mixed $value, array $flags): bool
    {
        if (!\is_array($value) || !\array_key_exists(Keyword::ID->value, $value)) {
            return false;
        }

        $nodeObject = $this->subjects[$value[Keyword::ID->value]] ?? null;

        return null !== $nodeObject && $this->filterSubject($nodeObject, $pattern, $flags);
    }

    /**
     * A value object matches the value pattern when the pattern is empty, or when
     * its "@value", "@type" and "@language" entries all match (an empty map is a
     * wildcard, an empty array matches only a missing entry).
     */
    private function valueMatch(mixed $pattern, mixed $value): bool
    {
        if (!\is_array($value) || !\array_key_exists(Keyword::VALUE->value, $value)) {
            return false;
        }

        // A wildcard pattern matches any value object.
        if (self::isEmptyMap($pattern)) {
            return true;
        }

        if (!\is_array($pattern)) {
            return false;
        }

        $v1 = $value[Keyword::VALUE->value];
        $t1 = $value[Keyword::TYPE->value] ?? null;
        $l1 = $value[Keyword::LANGUAGE->value] ?? null;

        $v2 = self::patternValues($pattern, Keyword::VALUE->value);
        $t2 = self::patternValues($pattern, Keyword::TYPE->value);
        $l2 = self::patternValues($pattern, Keyword::LANGUAGE->value);

        if ([] === $v2 && [] === $t2 && [] === $l2) {
            return true;
        }

        if (!(\in_array($v1, $v2, true) || self::isEmptyMap($v2[0] ?? null))) {
            return false;
        }

        if (!((null === $t1 && [] === $t2) || \in_array($t1, $t2, true) || (null !== $t1 && self::isEmptyMap($t2[0] ?? null)))) {
            return false;
        }

        return (null === $l1 && [] === $l2) || \in_array($l1, $l2, true) || (null !== $l1 && self::isEmptyMap($l2[0] ?? null));
    }

    /**
     * @param array<string, mixed> $flags
     *
     * @return array<int, array<string, mixed>>
     */
    private function createImplicitFrame(array $flags): array
    {
        $frame = [];

        foreach ($flags as $name => $value) {
            $frame['@' . $name] = [$value];
        }

        return [$frame];
    }

    /**
     * @param array<string, mixed> $subject
     */
    private function createsCircularReference(array $subject): bool
    {
        for ($position = \count($this->subjectStack) - 1; $position >= 0; --$position) {
            $entry = $this->subjectStack[$position];

            if (
                $entry['graph'] === $this->graph
                && ($entry['subject'][Keyword::ID->value] ?? null) === ($subject[Keyword::ID->value] ?? null)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<string, mixed> $frame
     */
    private function getFrameFlag(array $frame, string $name): mixed
    {
        $flag = '@' . $name;

        if (\array_key_exists($flag, $frame)) {
            $value = $frame[$flag];

            // The expanded flag value may be a value object, wrapped in an array or not.
            if (\is_array($value) && array_is_list($value)) {
                $value = $value[0] ?? null;
            }

            if (\is_array($value) && \array_key_exists(Keyword::VALUE->value, $value)) {
                $value = $value[Keyword::VALUE->value];
            }
        } else {
            $value = $this->frameOptions[$name];
        }

        if ('embed' === $name) {
            if (true === $value) {
                $value = '@once';
            } elseif (false === $value) {
                $value = '@never';
            } elseif (!\in_array($value, ['@always', '@never', '@link', '@first', '@last', '@once'], true)) {
                throw new JsonLdException('invalid @embed value');
            }
        }

        return $value;
    }

    /**
     * @param array<mixed> $frame
     */
    private function validateFrame(array $frame): void
    {
        if (1 !== \count($frame)) {
            throw new JsonLdException('invalid frame');
        }

        if (self::isEmptyMap($frame[0])) {
            return;
        }

        if (!\is_array($frame[0]) || (array_is_list($frame[0]) && [] !== $frame[0])) {
            throw new JsonLdException('invalid frame');
        }

        $frameObject = $frame[0];

        foreach ((array) ($frameObject[Keyword::ID->value] ?? []) as $id) {
            if (self::isEmptyMap($id)) {
                continue;
            }

            if (!\is_string($id) || !IriResolver::isAbsoluteIri($id) || str_starts_with($id, '_:')) {
                throw new JsonLdException('invalid frame');
            }
        }

        foreach ((array) ($frameObject[Keyword::TYPE->value] ?? []) as $type) {
            if (self::isEmptyMap($type) || (\is_array($type) && \array_key_exists('@default', $type))) {
                continue;
            }

            if (!\is_string($type) || !(IriResolver::isAbsoluteIri($type) || Keyword::JSON->value === $type) || str_starts_with($type, '_:')) {
                throw new JsonLdException('invalid frame');
            }
        }
    }

    private function removeEmbed(string $id): void
    {
        $embed = $this->uniqueEmbeds[$this->graph][$id];
        $property = $embed['property'];

        $subjectReference = [Keyword::ID->value => $id];

        if (null !== $property && \is_array($embed['parent']) && !array_is_list($embed['parent'])) {
            $values = $embed['parent'][$property] ?? [];

            foreach ($values as $index => $value) {
                if (($value[Keyword::ID->value] ?? null) === $id) {
                    $embed['parent'][$property][$index] = $subjectReference;

                    break;
                }
            }
        } elseif (\is_array($embed['parent'])) {
            foreach ($embed['parent'] as $index => $value) {
                if (($value[Keyword::ID->value] ?? null) === $id) {
                    $embed['parent'][$index] = $subjectReference;

                    break;
                }
            }
        }

        // Recursively remove the dependent dangling embeds.
        $this->removeDependentEmbeds($id);
    }

    private function removeDependentEmbeds(string $id): void
    {
        $embeds = &$this->uniqueEmbeds[$this->graph];

        foreach (array_keys($embeds) as $next) {
            if (
                isset($embeds[$next]['parent'])
                && \is_array($embeds[$next]['parent'])
                && ($embeds[$next]['parent'][Keyword::ID->value] ?? null) === $id
            ) {
                unset($embeds[$next]);
                $this->removeDependentEmbeds($next);
            }
        }
    }

    /**
     * Removes the @preserve entries from the framing output, and clears the
     * identifiers of blank nodes that are only referenced once.
     */
    private function cleanupPreserve(mixed $input): mixed
    {
        if (\is_array($input) && array_is_list($input)) {
            return array_map(fn (mixed $value): mixed => $this->cleanupPreserve($value), $input);
        }

        if (\is_array($input)) {
            if (\array_key_exists('@preserve', $input)) {
                return $input['@preserve'][0];
            }

            if (\array_key_exists(Keyword::VALUE->value, $input)) {
                return $input;
            }

            if (\array_key_exists(Keyword::LIST->value, $input)) {
                $input[Keyword::LIST->value] = $this->cleanupPreserve($input[Keyword::LIST->value]);

                return $input;
            }

            foreach ($input as $key => $value) {
                if (Keyword::ID->value === $key && \in_array($value, $this->bnodesToClear, true)) {
                    unset($input[Keyword::ID->value]);

                    continue;
                }

                $input[$key] = $this->cleanupPreserve($value);
            }
        }

        return $input;
    }

    /**
     * Replaces "@null" with null, removing it from arrays.
     */
    private function cleanupNull(mixed $input): mixed
    {
        if (\is_array($input)) {
            $cleaned = array_map(fn (mixed $value): mixed => $this->cleanupNull($value), $input);

            return array_values(array_filter($cleaned, static fn (mixed $value): bool => null !== $value));
        }

        if ('@null' === $input) {
            return null;
        }

        if ($input instanceof \stdClass) {
            foreach (get_object_vars($input) as $key => $value) {
                $input->{$key} = $this->cleanupNull($value);
            }
        }

        return $input;
    }

    /**
     * @param array<mixed>|array<string, mixed> $parent
     */
    private static function addFrameOutput(array &$parent, ?string $property, mixed $output): void
    {
        if (null !== $property) {
            $parent[$property] ??= [];
            $parent[$property][] = $output;

            return;
        }

        $parent[] = $output;
    }

    /**
     * @param array<string, mixed> $subject
     *
     * @return array<mixed>
     */
    private function getValues(array $subject, string $key): array
    {
        $values = $subject[$key] ?? [];

        return \is_array($values) && array_is_list($values) ? $values : [$values];
    }

    private function isSubjectReference(mixed $value): bool
    {
        return \is_array($value)
            && 1 === \count($value)
            && \array_key_exists(Keyword::ID->value, $value);
    }

    /**
     * @param array<string, mixed> $pattern
     *
     * @return array<mixed>
     */
    private static function patternValues(array $pattern, string $key): array
    {
        if (!\array_key_exists($key, $pattern)) {
            return [];
        }

        $values = $pattern[$key];

        return \is_array($values) && array_is_list($values) ? $values : [$values];
    }

    private static function isEmptyMap(mixed $value): bool
    {
        return $value instanceof \stdClass && [] === get_object_vars($value);
    }

    private static function isKeywordString(string $value): bool
    {
        return null !== Keyword::tryFrom($value)
            || null !== FramingKeyword::tryFrom($value)
            || '@preserve' === $value
            || '@default' === $value
            || '@null' === $value;
    }

    /**
     * Normalizes the expander output (stdClass-based) into nested associative
     * arrays, which the framing algorithm manipulates. Empty maps are kept as
     * stdClass instances: in a frame, an empty map is a wildcard while an empty
     * array matches the absence of a value, and the distinction must survive.
     *
     * @return array<int, array<string, mixed>>
     */
    private static function asArrayData(mixed $data): array
    {
        $converted = self::convertToArrays($data);

        if ($converted instanceof \stdClass || [] === $converted || !\is_array($converted)) {
            // An empty (or dropped-empty) frame is the wildcard frame.
            return [[]];
        }

        return array_is_list($converted) ? $converted : [$converted];
    }

    private static function convertToArrays(mixed $data): mixed
    {
        if ($data instanceof \stdClass) {
            $entries = get_object_vars($data);

            if ([] === $entries) {
                return $data;
            }

            return array_map(static fn (mixed $value): mixed => self::convertToArrays($value), $entries);
        }

        if (\is_array($data)) {
            return array_map(static fn (mixed $value): mixed => self::convertToArrays($value), $data);
        }

        return $data;
    }
}
