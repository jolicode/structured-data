<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Http;

use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\TermDefinition\TermDefinitionCreator;
use League\Uri\Uri;

class IriResolver
{
    /**
     * Implementation of the W3C IRI Expansion algorithm : https://www.w3.org/TR/json-ld-api/#iri-expansion
     * It is based on the 16th July 2020 recommendation.
     */
    public static function expand(
        Context $activeContext,
        string $value,
        bool $documentRelative = false,
        bool $vocab = true,
        ?\stdClass $localContext = null,
        array &$defined = []
    ): ?string {
        // 1
        if (Keyword::tryFrom($value)) {
            return $value;
        }

        // 2
        if (preg_match('/^@[a-zA-Z]+$/', $value)) {
            return null;
        }

        // 3
        if (
            $localContext &&
            property_exists($localContext, $value) &&
            \array_key_exists($value, $defined) &&
            !$defined[$value]
        ) {
            TermDefinitionCreator::create($activeContext, $localContext, $value, $defined);
        }

        // 4
        if (
            \array_key_exists($value, $activeContext->termDefinitions) &&
            $activeContext->termDefinitions[$value]->iriMapping &&
            ($keyword = Keyword::tryFrom($activeContext->termDefinitions[$value]->iriMapping))
        ) {
            return $keyword->value;
        }

        // 5
        if ($vocab && \array_key_exists($value, $activeContext->termDefinitions)) {
            return $activeContext->termDefinitions[$value]->iriMapping;
        }

        // 6
        if (preg_match('/[^^]:/', $value)) {
            // 6.1
            [$prefix, $suffix] = explode(':', $value, 2);

            // 6.2
            if ('_' === $prefix || str_starts_with($suffix, '//')) {
                return $value;
            }

            // 6.3
            if (
                $localContext &&
                property_exists($localContext, $prefix) &&
                (!\array_key_exists($prefix, $defined) || true !== $defined[$prefix])
            ) {
                TermDefinitionCreator::create($activeContext, $localContext, $prefix, $defined);
            }

            // 6.4
            if (\array_key_exists($prefix, $activeContext->termDefinitions)) {
                $termDefinition = $activeContext->termDefinitions[$prefix];

                if (null !== $termDefinition->iriMapping && $termDefinition->prefixFlag) {
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

        if (preg_match('/^.*[\s].*?/', $iri)) {
            return false;
        }

        return self::isRelativeIri($iri) || self::isAbsoluteIri($iri);
    }

    public static function isRelativeIri(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        return preg_match('/^(?:[^\s]*)|(?:\.\.|\.)\/?/', $iri);
    }

    public static function isAbsoluteIri(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        return preg_match('/^[A-Za-z][A-Za-z0-9+-.]*:[^\s]*$/', $iri);
    }

    public static function isBlankNodeIdentifier(mixed $iri): bool
    {
        if (!\is_string($iri)) {
            return false;
        }

        return preg_match('/^_:[^\s]*$/', $iri);
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

        return (string) Uri::createFromBaseUri($iri, $base);
    }
}
