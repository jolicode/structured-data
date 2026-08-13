<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Http;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinitionCreator;
use League\Uri\Uri;

class IriResolver
{
    private const ASCII_LETTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private const ASCII_SCHEME_CHARS = self::ASCII_LETTERS . '0123456789+-.';

    private const ASCII_WHITESPACE = " \t\n\r\v\f";

    private const GEN_DELIM_ENDINGS = [
        ':' => true,
        '/' => true,
        '?' => true,
        '#' => true,
        '[' => true,
        ']' => true,
        '@' => true,
    ];

    /**
     * This is a PHP implementation of the IRI Expansion algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld-api/#iri-expansion
     */
    public static function expand(
        Context $activeContext,
        string $value,
        bool $documentRelative = false,
        bool $vocab = true,
        ?\stdClass $localContext = null,
        array &$defined = [],
    ): ?string {
        // 1
        if (Keyword::tryFrom($value)) {
            return $value;
        }

        // 2
        if (self::isKeywordLikeString($value)) {
            return null;
        }

        // 3
        if (
            $localContext
            && property_exists($localContext, $value)
            && \array_key_exists($value, $defined)
            && !$defined[$value]
        ) {
            TermDefinitionCreator::create($activeContext, $localContext, $value, $defined);
        }

        // 4
        if (
            \array_key_exists($value, $activeContext->termDefinitions)
            && $activeContext->termDefinitions[$value]->iriMapping
            && ($keyword = Keyword::tryFrom($activeContext->termDefinitions[$value]->iriMapping))
        ) {
            return $keyword->value;
        }

        // 5
        if ($vocab && \array_key_exists($value, $activeContext->termDefinitions)) {
            return $activeContext->termDefinitions[$value]->iriMapping;
        }

        // 6
        if (self::hasPrefixSeparator($value)) {
            // 6.1
            [$prefix, $suffix] = explode(':', $value, 2);

            // 6.2
            if ('_' === $prefix || str_starts_with($suffix, '//')) {
                return $value;
            }

            // 6.3
            if (
                $localContext
                && property_exists($localContext, $prefix)
                && (!\array_key_exists($prefix, $defined) || true !== $defined[$prefix])
            ) {
                TermDefinitionCreator::create($activeContext, $localContext, $prefix, $defined);
            }

            // 6.4
            if (\array_key_exists($prefix, $activeContext->termDefinitions)) {
                $termDefinition = $activeContext->termDefinitions[$prefix];

                // In JSON-LD 1.0, any defined term acts as a prefix during expansion;
                // the prefix flag only restricts this in 1.1 processing mode.
                if (
                    null !== $termDefinition->iriMapping
                    && ($termDefinition->prefixFlag || Context::PROCESSING_MODE_10 === $activeContext->processingMode)
                ) {
                    return $termDefinition->iriMapping . $suffix;
                }
            }

            // 6.5
            if (self::isAbsoluteIri($value)) {
                return $value;
            }
        }

        // 7
        if ($vocab && $activeContext->vocabularyMapping) {
            return $activeContext->vocabularyMapping . $value;
        }

        // 8
        if ($documentRelative) {
            if ('' === $activeContext->baseIri && $activeContext->baseUrl) {
                $value = self::resolveIri($activeContext->baseUrl, $value);
            } else {
                $value = self::resolveIri($activeContext->baseIri, $value);
            }
        }

        // 9
        return $value;
    }

    public static function isIri(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        return !self::containsWhitespace($iri);
    }

    public static function isRelativeIri(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        if (self::containsWhitespace($iri)) {
            return false;
        }

        // According to RFC 3986, a relative IRI is any IRI-shaped string (so, without whitespaces) that isn't absolute.
        // Actually implementing the real relative IRI validation is incredibly complex and overkill for our limited use case.
        return !self::isAbsoluteIri($iri);
    }

    /**
     * Permissive absolute IRI/URI shape check.
     * This is because JSON-LD uses absolute identifiers (URN scheme) that are not fetchable over HTTP.
     * Use League\Uri when strict web URL validation is required.
     */
    public static function isAbsoluteIri(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        if ('' === $iri || self::containsWhitespace($iri) || !self::isAsciiLetter($iri[0])) {
            return false;
        }

        $separatorPosition = strpos($iri, ':');

        return false !== $separatorPosition && $separatorPosition === strspn($iri, self::ASCII_SCHEME_CHARS);
    }

    public static function isBlankNodeIdentifier(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        return isset($iri[0], $iri[1])
            && '_' === $iri[0]
            && ':' === $iri[1]
            && !self::containsWhitespace($iri);
    }

    public static function isAbsoluteIriOrBlankNode(mixed $iri): bool
    {
        return self::isAbsoluteIri($iri) || self::isBlankNodeIdentifier($iri);
    }

    public static function resolveIri(?string $base, string $iri): string
    {
        if (!$base) {
            return $iri;
        }

        if (self::isAbsoluteIriOrBlankNode($iri)) {
            return $iri;
        }

        return (string) Uri::parse($iri, $base);
    }

    public static function isKeywordLikeString(string $value): bool
    {
        if (!isset($value[0]) || '@' !== $value[0]) {
            return false;
        }

        $keywordLength = \strlen($value) - 1;

        return $keywordLength > 0 && strspn($value, self::ASCII_LETTERS, 1) === $keywordLength;
    }

    public static function iriMappingActsAsPrefix(string $iriMapping): bool
    {
        if (self::isBlankNodeIdentifier($iriMapping)) {
            return true;
        }

        return isset(self::GEN_DELIM_ENDINGS[$iriMapping[\strlen($iriMapping) - 1]]);
    }

    private static function hasPrefixSeparator(string $value): bool
    {
        $position = strpos($value, ':');

        return false !== $position && 0 !== $position && '^' !== $value[$position - 1];
    }

    private static function containsWhitespace(string $value): bool
    {
        return \strlen($value) !== strcspn($value, self::ASCII_WHITESPACE);
    }

    private static function isAsciiLetter(string $character): bool
    {
        return 1 === strspn($character, self::ASCII_LETTERS);
    }
}
