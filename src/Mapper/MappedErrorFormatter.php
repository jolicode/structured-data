<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\JsonLd\Parser\Range;

/**
 * Formats the type label and the source ranges carried by a MappedError.
 *
 * Both the validators (when an error is first created) and the validation snippet
 * cache (when an error is replayed from a cached snippet) must produce the exact
 * same strings, otherwise a cache hit would report differently from a cache miss.
 * Sharing one implementation is what makes that invariant structural.
 */
final class MappedErrorFormatter
{
    /**
     * @param string|array<string>|null $typeLabel
     */
    public static function formatTypeLabel(string|array|null $typeLabel): ?string
    {
        if (!\is_array($typeLabel)) {
            return $typeLabel;
        }

        return \sprintf('[%s]', implode(', ', $typeLabel));
    }

    /**
     * @param array<Range> $ranges
     */
    public static function formatRanges(array $ranges): string
    {
        $formattedRanges = array_map(
            static fn (Range $range) => \sprintf(
                '%d:%d to %d:%d',
                $range->start?->line,
                $range->start?->column,
                $range->end?->line,
                $range->end?->column,
            ),
            $ranges,
        );

        return implode(\PHP_EOL, $formattedRanges);
    }
}
