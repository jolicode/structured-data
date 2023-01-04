<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Utils;

use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\TermDefinition\CreateTermDefinition;

class IriUtil
{
    /**
     * Implementation of the W3C IRI Expansion algorithm : https://www.w3.org/TR/json-ld-api/#iri-expansion
     * It is based on the 16th July 2020 recommendation.
     */
    public static function expand(
        Context $activeContext,
        mixed $value,
        bool $documentRelative = false,
        bool $vocab = false,
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
        if (isset($activeContext->$value) && Keyword::tryFrom($activeContext->$value)) {
            return Keyword::from($activeContext->$value);
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
            // IRI manipulation stuff : will be implemented soon.
        }

        // 9
        return $value;
    }

    public static function isIri(string $iri): bool
    {
        return preg_match('/^https?:\/\/[^\s]*$/', $iri);
    }

    public static function isAbsoluteIriOrBlankNode(string $url): bool
    {
        return preg_match('/^([A-Za-z][A-Za-z0-9+-.]*|_):[^\s]*$/', $url);
    }
}
