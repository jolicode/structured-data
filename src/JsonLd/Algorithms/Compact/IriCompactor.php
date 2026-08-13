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
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;

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
            $term = TermSelector::selectBestMatchingTerm($this, $activeContext, $variable, $value, $reverse);

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

    private function indexingIsPreserved(\stdClass $value, ?TermDefinition $termDefinition): bool
    {
        if (!property_exists($value, Keyword::INDEX->value)) {
            return true;
        }

        return \in_array(Keyword::INDEX->value, $termDefinition->containerMapping ?? [], true);
    }
}
