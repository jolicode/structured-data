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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ExpansionException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * Steps 15 to 19 of the Expansion algorithm: the checks and rewrites applied to
 * an expanded result once all of its entries have been processed.
 *
 * see https://www.w3.org/TR/json-ld-api/#expansion-algorithm
 */
final class ExpansionResultFinalizer
{
    public static function handleResultValueEntry(\stdClass $result, ProcessorOptions $options): bool
    {
        // 15.1
        ExpansionValidator::validateResultValue($result);

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

    public static function handleResultSetAndListEntries(\stdClass &$result): void
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

    public static function handleNullPropertyAndGraphProperty(\stdClass|array &$result, ProcessorOptions $options): bool
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
}
