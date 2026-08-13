<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Frame;

use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Data shaping helpers of the framing algorithm: node map merging, output
 * accumulation, and conversion of the expander output to nested arrays.
 */
final class FrameData
{
    /**
     * @param array<string, array<string, array<string, mixed>>> $graphMap
     *
     * @return array<string, array<string, mixed>>
     */
    public static function mergeNodeMapGraphs(array $graphMap): array
    {
        $merged = [];

        foreach ($graphMap as $graph) {
            foreach ($graph as $id => $node) {
                $merged[$id] ??= [Keyword::ID->value => $id];

                foreach ($node as $nodeProperty => $values) {
                    if (Keyword::ID->value === $nodeProperty) {
                        continue;
                    }

                    if (Keyword::tryFrom((string) $nodeProperty) && Keyword::TYPE->value !== $nodeProperty) {
                        $merged[$id][$nodeProperty] = $values;

                        continue;
                    }

                    foreach ((array) $values as $value) {
                        if (!\in_array($value, $merged[$id][$nodeProperty] ?? [], true)) {
                            $merged[$id][$nodeProperty][] = $value;
                        }
                    }
                }
            }
        }

        return $merged;
    }

    /**
     * @param array<mixed>|array<string, mixed> $parent
     */
    public static function addFrameOutput(array &$parent, ?string $property, mixed $output): void
    {
        if (null !== $property) {
            $parent[$property] ??= [];
            $parent[$property][] = $output;

            return;
        }

        $parent[] = $output;
    }

    /**
     * Normalizes the expander output (stdClass-based) into nested associative
     * arrays, which the framing algorithm manipulates. Empty maps are kept as
     * stdClass instances: in a frame, an empty map is a wildcard while an empty
     * array matches the absence of a value, and the distinction must survive.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function asArrayData(mixed $data): array
    {
        $converted = self::convertToArrays($data);

        if ($converted instanceof \stdClass || [] === $converted || !\is_array($converted)) {
            // An empty (or dropped-empty) frame is the wildcard frame.
            return [[]];
        }

        return array_is_list($converted) ? $converted : [$converted];
    }

    public static function convertToArrays(mixed $data): mixed
    {
        if ($data instanceof \stdClass) {
            $entries = get_object_vars($data);

            if ([] === $entries) {
                return $data;
            }

            return array_map(static fn (mixed $value): mixed => self::convertToArrays($value), $entries);
        }

        if (\is_array($data)) {
            return array_map(static fn (mixed $value): mixed => self::convertToArrays($value), $data);
        }

        return $data;
    }
}
