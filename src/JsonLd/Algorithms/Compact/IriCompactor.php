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
use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\TermDefinition\TermDefinition;

final class IriCompactor
{
    public function __construct(
        private readonly ProcessorOptions $options = new ProcessorOptions(),
    ) {
    }

    /**
     * This is a PHP implementation of the IRI Compaction algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#iri-compaction
     */
    public function compactIri(
        Context $activeContext,
        ?string $variable,
        mixed $value = null,
        bool $vocab = false,
        bool $reverse = false,
    ): ?string {
        // 1
        if (null === $variable) {
            return null;
        }

        // 2
        $activeContext->inverseContext ??= InverseContextCreator::create($activeContext);

        // 3
        // 4
        if ($vocab && isset($activeContext->inverseContext[$variable])) {
            $term = $this->selectBestMatchingTerm($activeContext, $variable, $value, $reverse);

            // 4.19
            if (null !== $term) {
                return $term;
            }
        }

        // 5
        if ($vocab && null !== $activeContext->vocabularyMapping) {
            $vocabularyMapping = $activeContext->vocabularyMapping;

            // 5.1
            if (str_starts_with($variable, $vocabularyMapping) && \strlen($variable) > \strlen($vocabularyMapping)) {
                $suffix = substr($variable, \strlen($vocabularyMapping));

                if (!\array_key_exists($suffix, $activeContext->termDefinitions)) {
                    return $suffix;
                }
            }
        }

        // 6
        $compactIri = null;

        foreach ($activeContext->termDefinitions as $term => $termDefinition) {
            // 6.1
            if (
                null === $termDefinition->iriMapping
                || $termDefinition->iriMapping === $variable
                || !$termDefinition->prefixFlag
                || !str_starts_with($variable, $termDefinition->iriMapping)
            ) {
                continue;
            }

            // 6.2
            $candidate = $term . ':' . substr($variable, \strlen($termDefinition->iriMapping));

            // 6.3
            $candidateIsShorter = null === $compactIri
                || \strlen($candidate) < \strlen($compactIri)
                || (\strlen($candidate) === \strlen($compactIri) && strcmp($candidate, $compactIri) < 0);
            $candidateDefinition = $activeContext->termDefinitions[$candidate] ?? null;
            $candidateIsUsable = !\array_key_exists($candidate, $activeContext->termDefinitions)
                || ($candidateDefinition instanceof TermDefinition && $candidateDefinition->iriMapping === $variable && null === $value);

            if ($candidateIsShorter && $candidateIsUsable) {
                $compactIri = $candidate;
            }
        }

        // 7
        if (null !== $compactIri) {
            return $compactIri;
        }

        // If the IRI could be confused with a compact IRI using a prefix term of the
        // active context, it cannot be represented unambiguously.
        foreach ($activeContext->termDefinitions as $term => $termDefinition) {
            if ($termDefinition->prefixFlag && str_starts_with($variable, $term . ':')) {
                throw new JsonLdException('IRI confused with prefix');
            }
        }

        // 8
        if (!$vocab && $this->options->compactToRelative && null !== $activeContext->baseIri) {
            return self::makeRelative($activeContext->baseIri, $variable);
        }

        // 9
        return $variable;
    }

    /**
     * This is a PHP implementation of the Value Compaction algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#value-compaction
     */
    public function compactValue(Context $activeContext, ?string $activeProperty, \stdClass $value): mixed
    {
        // 1
        $result = clone $value;

        // 2
        $activeContext->inverseContext ??= InverseContextCreator::create($activeContext);

        $termDefinition = null !== $activeProperty
            ? ($activeContext->termDefinitions[$activeProperty] ?? null)
            : null;

        // 3
        $language = $termDefinition instanceof TermDefinition && false !== $termDefinition->languageMapping
            ? $termDefinition->languageMapping
            : $activeContext->defaultLangage;

        // 4
        $direction = $termDefinition instanceof TermDefinition && false !== $termDefinition->directionMapping
            ? $termDefinition->directionMapping
            : $activeContext->defaultBaseDirection;

        $valueEntries = get_object_vars($value);
        $entriesOtherThanIdAndIndex = array_diff(array_keys($valueEntries), [Keyword::ID->value, Keyword::INDEX->value]);
        $typeMapping = $termDefinition?->typeMapping;

        if (property_exists($value, Keyword::ID->value) && [] === $entriesOtherThanIdAndIndex) {
            // 5
            if (Keyword::ID->value === $typeMapping) {
                // 5.1
                $result = $this->compactIri($activeContext, $value->{Keyword::ID->value});
            } elseif (Keyword::VOCAB->value === $typeMapping) {
                // 5.2
                $result = $this->compactIri($activeContext, $value->{Keyword::ID->value}, vocab: true);
            }
        } elseif (property_exists($value, Keyword::TYPE->value) && $value->{Keyword::TYPE->value} === $typeMapping) {
            // 6
            $result = $value->{Keyword::VALUE->value};
        } elseif (Keyword::NONE->value === $typeMapping || (property_exists($value, Keyword::TYPE->value) && $value->{Keyword::TYPE->value} !== $typeMapping)) {
            // 7
            if (property_exists($result, Keyword::TYPE->value)) {
                $types = (array) $result->{Keyword::TYPE->value};
                $compactedTypes = [];

                foreach ($types as $type) {
                    $compactedTypes[] = $this->compactIri($activeContext, $type, vocab: true);
                }

                $result->{Keyword::TYPE->value} = \is_array($result->{Keyword::TYPE->value}) ? $compactedTypes : $compactedTypes[0];
            }
        } elseif (property_exists($value, Keyword::VALUE->value) && !\is_string($value->{Keyword::VALUE->value})) {
            // 8
            // 8.1
            if ($this->indexingIsPreserved($value, $termDefinition)) {
                $result = $value->{Keyword::VALUE->value};
            }
        } elseif (
            property_exists($value, Keyword::VALUE->value)
            && (property_exists($value, Keyword::LANGUAGE->value) ? 0 === strcasecmp((string) $value->{Keyword::LANGUAGE->value}, (string) $language) : null === $language)
            && (property_exists($value, Keyword::DIRECTION->value) ? $value->{Keyword::DIRECTION->value} === $direction : null === $direction)
        ) {
            // 9
            // 9.1
            if ($this->indexingIsPreserved($value, $termDefinition)) {
                $result = $value->{Keyword::VALUE->value};
            }
        }

        // 10
        if ($result instanceof \stdClass) {
            $compactedResult = new \stdClass();

            foreach (get_object_vars($result) as $key => $entryValue) {
                $compactedKey = (string) $this->compactIri($activeContext, $key, vocab: true);
                $compactedResult->{$compactedKey} = $entryValue;
            }

            $result = $compactedResult;
        }

        // 11
        return $result;
    }

    /**
     * Transforms an absolute IRI into an IRI reference relative to the given base,
     * as mandated by step 8 of the IRI Compaction algorithm.
     */
    public static function makeRelative(string $base, string $iri): string
    {
        $baseParts = parse_url($base);
        $iriParts = parse_url($iri);

        if (false === $baseParts || false === $iriParts) {
            return $iri;
        }

        if (
            ($baseParts['scheme'] ?? null) !== ($iriParts['scheme'] ?? null)
            || ($baseParts['host'] ?? null) !== ($iriParts['host'] ?? null)
            || ($baseParts['port'] ?? null) !== ($iriParts['port'] ?? null)
            || ($baseParts['user'] ?? null) !== ($iriParts['user'] ?? null)
        ) {
            return $iri;
        }

        $basePath = $baseParts['path'] ?? '/';
        $iriPath = $iriParts['path'] ?? '/';
        $iriQuery = isset($iriParts['query']) ? '?' . $iriParts['query'] : '';
        $iriFragment = isset($iriParts['fragment']) ? '#' . $iriParts['fragment'] : '';

        // Same document: only the query and/or the fragment differ.
        if ($basePath === $iriPath) {
            $baseQuery = isset($baseParts['query']) ? '?' . $baseParts['query'] : '';

            if ('' !== $iriFragment && $baseQuery === $iriQuery) {
                return $iriFragment;
            }

            if ('' !== $iriQuery) {
                return $iriQuery . $iriFragment;
            }

            if ('' === $iriFragment) {
                // An empty relative reference resolves to the base without its
                // fragment; use the last path segment instead.
                $baseSegments = explode('/', $basePath);

                return (string) end($baseSegments);
            }

            return $iriFragment;
        }

        $baseSegments = explode('/', $basePath);
        $iriSegments = explode('/', $iriPath);

        // The last base segment is the "file" part and never counts as a common directory.
        array_pop($baseSegments);
        $commonSegments = 0;

        while (
            isset($baseSegments[$commonSegments], $iriSegments[$commonSegments])
            && $baseSegments[$commonSegments] === $iriSegments[$commonSegments]
            && $commonSegments < \count($iriSegments) - 1
        ) {
            ++$commonSegments;
        }

        $relativeSegments = [
            ...array_fill(0, \count($baseSegments) - $commonSegments, '..'),
            ...\array_slice($iriSegments, $commonSegments),
        ];

        $relative = implode('/', $relativeSegments);

        if ('' === $relative) {
            $relative = './';
        }

        // A relative reference must not be confused with a keyword ("@...") nor with
        // an absolute IRI (first segment containing a colon).
        $firstSegment = explode('/', $relative)[0];

        if (str_starts_with($relative, '@') || str_contains($firstSegment, ':')) {
            $relative = './' . $relative;
        }

        return $relative . $iriQuery . $iriFragment;
    }

    public static function isListObject(mixed $value): bool
    {
        return $value instanceof \stdClass && property_exists($value, Keyword::LIST->value);
    }

    public static function isGraphObject(mixed $value): bool
    {
        if (!$value instanceof \stdClass || !property_exists($value, Keyword::GRAPH->value)) {
            return false;
        }

        // A graph object has no entries other than @graph, @id, @index and @context:
        // a node object that merely embeds a named graph is not a graph object.
        $allowedEntries = [Keyword::GRAPH->value, Keyword::ID->value, Keyword::INDEX->value, Keyword::CONTEXT->value];

        foreach (array_keys(get_object_vars($value)) as $entry) {
            if (!\in_array($entry, $allowedEntries, true)) {
                return false;
            }
        }

        return true;
    }

    public static function isSimpleGraphObject(mixed $value): bool
    {
        return self::isGraphObject($value) && !property_exists($value, Keyword::ID->value);
    }

    public static function isValueObject(mixed $value): bool
    {
        return $value instanceof \stdClass && property_exists($value, Keyword::VALUE->value);
    }

    /**
     * Steps 4.1 to 4.19 of the IRI Compaction algorithm: when compacting against the
     * vocabulary, find the best matching term for the IRI given the shape (container,
     * type, language) of the value it will hold.
     */
    private function selectBestMatchingTerm(Context $activeContext, string $variable, mixed $value, bool $reverse): ?string
    {
        // 4.1
        if (null !== $activeContext->defaultBaseDirection) {
            $defaultLanguage = strtolower($activeContext->defaultLangage . '_' . $activeContext->defaultBaseDirection);
        } elseif (null !== $activeContext->defaultLangage) {
            $defaultLanguage = strtolower($activeContext->defaultLangage);
        } else {
            $defaultLanguage = Keyword::NONE->value;
        }

        // 4.2
        if ($value instanceof \stdClass && property_exists($value, '@preserve')) {
            $preserved = $value->{'@preserve'};
            $value = \is_array($preserved) ? $preserved[0] : $preserved;
        }

        // 4.3
        $containers = [];

        // 4.4
        $typeLanguage = Keyword::LANGUAGE->value;
        $typeLanguageValue = InverseContextCreator::NULL;

        // 4.5
        if ($value instanceof \stdClass && property_exists($value, Keyword::INDEX->value) && !self::isGraphObject($value)) {
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;
        }

        if ($reverse) {
            // 4.6
            $typeLanguage = Keyword::TYPE->value;
            $typeLanguageValue = Keyword::REVERSE->value;
            $containers[] = Keyword::SET->value;
        } elseif (self::isListObject($value)) {
            // 4.7
            // 4.7.1
            if (!property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::LIST->value;
            }

            // 4.7.2
            $list = $value->{Keyword::LIST->value};

            // 4.7.3
            $commonType = null;
            $commonLanguage = [] === $list ? $defaultLanguage : null;

            // 4.7.4
            foreach ($list as $item) {
                // 4.7.4.1
                $itemLanguage = Keyword::NONE->value;
                $itemType = Keyword::NONE->value;

                // 4.7.4.2
                if ($item instanceof \stdClass && property_exists($item, Keyword::VALUE->value)) {
                    if (property_exists($item, Keyword::DIRECTION->value)) {
                        // 4.7.4.2.1
                        $itemLanguage = strtolower(($item->{Keyword::LANGUAGE->value} ?? '') . '_' . $item->{Keyword::DIRECTION->value});
                    } elseif (property_exists($item, Keyword::LANGUAGE->value)) {
                        // 4.7.4.2.2
                        $itemLanguage = strtolower((string) $item->{Keyword::LANGUAGE->value});
                    } elseif (property_exists($item, Keyword::TYPE->value)) {
                        // 4.7.4.2.3
                        $itemType = $item->{Keyword::TYPE->value};
                    } else {
                        // 4.7.4.2.4
                        $itemLanguage = InverseContextCreator::NULL;
                    }
                } else {
                    // 4.7.4.3
                    $itemType = Keyword::ID->value;
                }

                // 4.7.4.4
                if (null === $commonLanguage) {
                    $commonLanguage = $itemLanguage;
                } elseif ($commonLanguage !== $itemLanguage && $item instanceof \stdClass && property_exists($item, Keyword::VALUE->value)) {
                    // 4.7.4.5
                    $commonLanguage = Keyword::NONE->value;
                }

                // 4.7.4.6
                if (null === $commonType) {
                    $commonType = $itemType;
                } elseif ($commonType !== $itemType) {
                    // 4.7.4.7
                    $commonType = Keyword::NONE->value;
                }

                // 4.7.4.8
                if (Keyword::NONE->value === $commonLanguage && Keyword::NONE->value === $commonType) {
                    break;
                }
            }

            // 4.7.5
            $commonLanguage ??= Keyword::NONE->value;

            // 4.7.6
            $commonType ??= Keyword::NONE->value;

            // 4.7.7
            if (Keyword::NONE->value !== $commonType) {
                $typeLanguage = Keyword::TYPE->value;
                $typeLanguageValue = $commonType;
            } else {
                // 4.7.8
                $typeLanguageValue = $commonLanguage;
            }
        } elseif (self::isGraphObject($value)) {
            // 4.8
            // 4.8.1
            if ($value instanceof \stdClass && property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value;
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value . Keyword::SET->value;
            }

            // 4.8.2
            if ($value instanceof \stdClass && property_exists($value, Keyword::ID->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value;
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value . Keyword::SET->value;
            }

            // 4.8.3
            $containers[] = Keyword::GRAPH->value;
            $containers[] = Keyword::GRAPH->value . Keyword::SET->value;
            $containers[] = Keyword::SET->value;

            // 4.8.4
            if ($value instanceof \stdClass && !property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value;
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value . Keyword::SET->value;
            }

            // 4.8.5
            if ($value instanceof \stdClass && !property_exists($value, Keyword::ID->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value;
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value . Keyword::SET->value;
            }

            // 4.8.6
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;

            // 4.8.7
            $typeLanguage = Keyword::TYPE->value;
            $typeLanguageValue = Keyword::ID->value;
        } else {
            // 4.9
            if ($value instanceof \stdClass && property_exists($value, Keyword::VALUE->value)) {
                // 4.9.1
                if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::INDEX->value)) {
                    // 4.9.1.1
                    $typeLanguageValue = strtolower(($value->{Keyword::LANGUAGE->value} ?? '') . '_' . $value->{Keyword::DIRECTION->value});
                    $containers[] = Keyword::LANGUAGE->value;
                    $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
                } elseif (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::INDEX->value)) {
                    // 4.9.1.2
                    $typeLanguageValue = strtolower((string) $value->{Keyword::LANGUAGE->value});
                    $containers[] = Keyword::LANGUAGE->value;
                    $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
                } elseif (property_exists($value, Keyword::TYPE->value)) {
                    // 4.9.1.3
                    $typeLanguage = Keyword::TYPE->value;
                    $typeLanguageValue = $value->{Keyword::TYPE->value};
                }
            } else {
                // 4.9.2
                $typeLanguage = Keyword::TYPE->value;
                $typeLanguageValue = Keyword::ID->value;
                $containers[] = Keyword::ID->value;
                $containers[] = Keyword::ID->value . Keyword::SET->value;
                $containers[] = Keyword::TYPE->value;
                $containers[] = Keyword::SET->value . Keyword::TYPE->value;
            }

            // 4.9.3
            $containers[] = Keyword::SET->value;
        }

        // 4.10
        $containers[] = Keyword::NONE->value;

        // 4.11
        if (Context::PROCESSING_MODE_10 !== $activeContext->processingMode && (!$value instanceof \stdClass || !property_exists($value, Keyword::INDEX->value))) {
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;
        }

        // 4.12
        if (
            Context::PROCESSING_MODE_10 !== $activeContext->processingMode
            && $value instanceof \stdClass
            && property_exists($value, Keyword::VALUE->value)
            && 1 === \count(get_object_vars($value))
        ) {
            $containers[] = Keyword::LANGUAGE->value;
            $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
        }

        // 4.13
        if (null === $typeLanguageValue) {
            $typeLanguageValue = InverseContextCreator::NULL;
        }

        // 4.14
        $preferredValues = [];

        // 4.15
        if (Keyword::REVERSE->value === $typeLanguageValue) {
            $preferredValues[] = Keyword::REVERSE->value;
        }

        if (
            (Keyword::ID->value === $typeLanguageValue || Keyword::REVERSE->value === $typeLanguageValue)
            && $value instanceof \stdClass
            && property_exists($value, Keyword::ID->value)
        ) {
            // 4.16
            $compactedIdVocab = $this->compactIri($activeContext, $value->{Keyword::ID->value}, vocab: true);
            $compactedIdDefinition = null !== $compactedIdVocab
                ? ($activeContext->termDefinitions[$compactedIdVocab] ?? null)
                : null;

            if (
                $compactedIdDefinition instanceof TermDefinition
                && $compactedIdDefinition->iriMapping === $value->{Keyword::ID->value}
            ) {
                // 4.16.1
                $preferredValues[] = Keyword::VOCAB->value;
                $preferredValues[] = Keyword::ID->value;
                $preferredValues[] = Keyword::NONE->value;
            } else {
                // 4.16.2
                $preferredValues[] = Keyword::ID->value;
                $preferredValues[] = Keyword::VOCAB->value;
                $preferredValues[] = Keyword::NONE->value;
            }
        } else {
            // 4.17
            $preferredValues[] = $typeLanguageValue;
            $preferredValues[] = Keyword::NONE->value;

            if (self::isListObject($value) && [] === $value->{Keyword::LIST->value}) {
                $typeLanguage = InverseContextCreator::ANY;
            }
        }

        // 4.18
        $preferredValues[] = InverseContextCreator::ANY;

        // 4.19
        if (false !== ($underscorePosition = strpos($typeLanguageValue, '_'))) {
            $preferredValues[] = substr($typeLanguageValue, $underscorePosition);
        }

        // 4.20
        return InverseContextCreator::selectTerm($activeContext, $variable, $containers, $typeLanguage, $preferredValues);
    }

    private function indexingIsPreserved(\stdClass $value, ?TermDefinition $termDefinition): bool
    {
        if (!property_exists($value, Keyword::INDEX->value)) {
            return true;
        }

        return \in_array(Keyword::INDEX->value, $termDefinition->containerMapping ?? [], true);
    }
}
