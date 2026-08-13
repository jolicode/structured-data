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
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * Value checks of the Expansion algorithm: each method either returns true or
 * raises the ExpansionException the specification mandates.
 *
 * see https://www.w3.org/TR/json-ld-api/#expansion-algorithm
 */
final class ExpansionValidator
{
    // 13.4.4.1
    public static function validateValueForType(mixed $value, ProcessorOptions $options): bool
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
    public static function validateValueForValue(mixed $value, ProcessorOptions $options): bool
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
    public static function validateValueForLanguage(mixed $value, ProcessorOptions $options): bool
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

    public static function validateResultValue(\stdClass $result): bool
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
}
