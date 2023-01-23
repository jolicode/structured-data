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
use Jolicode\JsonLd\TermDefinition\CreateTermDefinition;

class IriResolver
{
    /**
     * Implementation of the W3C IRI Expansion algorithm : https://www.w3.org/TR/json-ld-api/#iri-expansion
     * It is based on the 16th July 2020 recommendation.
     */
    public static function expand(
        Context $activeContext,
        mixed $value,
        bool $documentRelative = false,
        bool $vocab = true,
        ?\stdClass $localContext = null,
        ?array $defined = null
    ): ?string {
        // 1
        if (null === $value || Keyword::tryFrom($value)) {
            return $value;
        }

        // 2
        if (preg_match('/^@\w+/', $value)) {
            // TODO: add a warning
            dump('WARNING: a value has the form of a keyword. Skipping. Value is : ' . $value);

            return null;
        }

        // 3
        if (
            $localContext &&
            property_exists($localContext, $value) &&
            $localContext->$value !== true
        ) {
            CreateTermDefinition::create($activeContext, $localContext, $value, $defined);
        }

        // 4
        if (
            \array_key_exists($value, $activeContext->options->termDefinitions) &&
            ($keyword = Keyword::tryFrom($activeContext->options->termDefinitions[$value]->iriMapping))
        ) {
            return $keyword->value;
        }

        // 5
        if ($vocab && \array_key_exists($value, $activeContext->options->termDefinitions)) {
            return $activeContext->options->termDefinitions[$value];
        }

        // 6
        if (preg_match('/[^^]:/', $value)) {
            // 6.1
            [$prefix, $suffix] = explode(':', $value, 2);

            // 6.2
            if ('_' === $prefix || str_starts_with('//', $suffix)) {
                return $value;
            }

            // 6.3
            if (
                $localContext &&
                property_exists($localContext, $prefix) &&
                (!\array_key_exists($prefix, $defined) || true !== $defined[$prefix])
            ) {
                CreateTermDefinition::create($activeContext, $localContext, $prefix, $defined);
            }

            // 6.4
            if (\array_key_exists($prefix, $activeContext->options->termDefinitions)) {
                $termDefinition = $activeContext->options->termDefinitions[$prefix];

                if (null !== $termDefinition->iriMapping && $termDefinition->prefixFlag) {
                    return $termDefinition->iriMapping . $suffix;
                }
            }

            // 6.5
            if (self::isIri($value)) {
                return $value;
            }
        }

        // 7
        if ($vocab && $activeContext->options->vocabularyMapping) {
            return $activeContext->options->vocabularyMapping . $value;
        }

        // 8
        if ($documentRelative) {
            $value = self::resolveIri($value, $activeContext->options->baseIri, false);
        }

        // 9
        return $value;
    }

    public static function isIri(?string $iri): bool
    {
        if (!$iri) {
            return false;
        }

        return preg_match('/^https?:\/\/[^\s]*$/', $iri);
    }

    public static function isAbsoluteIriOrBlankNode(string $url): bool
    {
        return preg_match('/^([A-Za-z][A-Za-z0-9+-.]*|_):[^\s]*$/', $url);
    }

    public static function resolveIri(?string $base, string $iri, bool $normalize = true): string
    {
        if (null === $base) {
            return $iri;
        }

        if (self::isAbsoluteIriOrBlankNode($iri)) {
            return $iri;
        }

        if (!$base || \is_string($base)) {
            $base = new Url($base, $normalize);
        }

        $url = new Url($iri, $normalize);

        if ($url->authority) {
            $base->authority = $url->authority;
            $base->path = $url->path;
            $base->query = $url->query;
        } else {
            if (!$url->path) {
                if ($url->query) {
                    $base->query = $url->query;
                }
            } else {
                if (str_starts_with($url->path, '/')) {
                    $base->path = $url->path;
                } else {
                    $path = substr($base->path, 0, strrpos($base->path, '/') + 1);

                    if ((\strlen($path) || $base->authority) && '/' !== $path[\strlen($path) - 1]) {
                        $path .= '/';
                    }

                    $path .= $url->path;
                    $base->path = $path;
                }
                $base->query = $url->query;
            }
        }

        if (!$url->path && $normalize) {
            $base->removeDotSegments();
            $base->path = $base->getNormalizedPath();
        }

        $resolved = $base->protocol;

        if ($base->authority) {
            $resolved .= '//' . $base->authority;
        }

        $resolved .= $base->path;

        if ($base->query) {
            $resolved .= '?' . $base->query;
        }

        if ($url->fragment) {
            $resolved .= '#' . $url->fragment;
        }

        if ('' === $resolved) {
            $resolved .= './';
        }

        return $resolved;
    }
}
