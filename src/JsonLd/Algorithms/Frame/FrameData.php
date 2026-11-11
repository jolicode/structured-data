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

                    $mergedValues = $merged[$id][$nodeProperty] ?? [];
                    $mergedValues = \is_array($mergedValues) ? $mergedValues : [$mergedValues];

                    foreach ((array) $values as $value) {
                        if (!\in_array($value, $mergedValues, true)) {
                            $mergedValues[] = $value;
                            $merged[$id][$nodeProperty] = $mergedValues;
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
            $values = $parent[$property] ?? [];
            $values = \is_array($values) ? $values : [$values];
            $values[] = $output;
            $parent[$property] = $values;

            return;
        }

        $parent[] = $output;
    }

    /**
     * The first entry of a frame value, which is always a list of frame objects.
     */
    public static function firstEntry(mixed $value): mixed
    {
        return \is_array($value) ? ($value[0] ?? null) : null;
    }

    /**
     * Normalizes a frame value into a list of frame objects: a frame entry may be
     * written as a single map instead of an array of maps.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function asFrameList(mixed $value): array
    {
        if (!\is_array($value)) {
            return [[]];
        }

        $frames = [];

        foreach (array_is_list($value) ? $value : [$value] as $frame) {
            $frames[] = \is_array($frame) ? $frame : [];
        }

        return [] === $frames ? [[]] : $frames;
    }

    /**
     * @param array<string, mixed> $node
     *
     * @return array<string, mixed>
     */
    public static function nodeToArrays(array $node): array
    {
        return array_map(static fn (mixed $value): mixed => self::convertToArrays($value), $node);
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
