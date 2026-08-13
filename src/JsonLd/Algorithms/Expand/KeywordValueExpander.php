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
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ExpansionException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\FramingKeyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * Step 13.4 of the Expansion algorithm: the keyword entries whose expanded value
 * is computed without recursing into the Expansion algorithm itself.
 *
 * see https://www.w3.org/TR/json-ld-api/#expansion-algorithm
 */
final class KeywordValueExpander
{
    public static function processIdKeyword(
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

    public static function processTypeKeyword(
        Context $typeScopedContext,
        array &$result,
        mixed $value,
        ProcessorOptions $options,
        array $expandedValue,
    ): mixed {
        // 13.4.4.1
        ExpansionValidator::validateValueForType($value, $options);

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

    public static function processValueKeyword(
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
            ExpansionValidator::validateValueForValue($value, $options);

            // 13.4.7.3
            $expandedValue = $value;
        }

        // 13.4.7.4
        if (null === $expandedValue) {
            $result[Keyword::VALUE->value] = null;
        }

        return $expandedValue;
    }

    public static function processLanguageKeyword(mixed $value, ProcessorOptions $options): mixed
    {
        // 13.4.8.1
        ExpansionValidator::validateValueForLanguage($value, $options);

        // 13.4.8.2: language tags are processed case-insensitively; processors
        // normalize them to lowercase.
        if (\is_string($value)) {
            $value = strtolower($value);
        }

        return $options->frameExpansion ? ($value instanceof \stdClass ? [$value] : (array) $value) : $value;
    }

    public static function processDirectionKeyword(Context $activeContext, mixed $value, ProcessorOptions $options): mixed
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

    public static function processIndexKeyword(mixed $value): string
    {
        // 13.4.10.1
        if (!\is_string($value)) {
            throw new ExpansionException('invalid @index value');
        }

        // 13.4.10.2
        return $value;
    }

    public static function processJsonTypeMapping(mixed $value): \stdClass
    {
        $expandedValue = new \stdClass();
        $expandedValue->{Keyword::VALUE->value} = $value;
        $expandedValue->{Keyword::TYPE->value} = Keyword::JSON->value;

        return $expandedValue;
    }
}
