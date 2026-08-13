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
 * Final cleanup of the framing output.
 */
final class FrameOutputCleaner
{
    /**
     * Removes the "@preserve" entries from the framing output, and clears the
     * identifiers of blank nodes that are only referenced once.
     *
     * @param array<string> $bnodesToClear
     */
    public static function cleanupPreserve(mixed $input, array $bnodesToClear): mixed
    {
        if (\is_array($input) && array_is_list($input)) {
            return array_map(static fn (mixed $value): mixed => self::cleanupPreserve($value, $bnodesToClear), $input);
        }

        if (\is_array($input)) {
            if (\array_key_exists('@preserve', $input)) {
                return $input['@preserve'][0];
            }

            if (\array_key_exists(Keyword::VALUE->value, $input)) {
                return $input;
            }

            if (\array_key_exists(Keyword::LIST->value, $input)) {
                $input[Keyword::LIST->value] = self::cleanupPreserve($input[Keyword::LIST->value], $bnodesToClear);

                return $input;
            }

            foreach ($input as $key => $value) {
                if (Keyword::ID->value === $key && \in_array($value, $bnodesToClear, true)) {
                    unset($input[Keyword::ID->value]);

                    continue;
                }

                $input[$key] = self::cleanupPreserve($value, $bnodesToClear);
            }
        }

        return $input;
    }

    /**
     * Replaces "@null" with null, removing it from arrays.
     */
    public static function cleanupNull(mixed $input): mixed
    {
        if (\is_array($input)) {
            $cleaned = array_map(static fn (mixed $value): mixed => self::cleanupNull($value), $input);

            return array_values(array_filter($cleaned, static fn (mixed $value): bool => null !== $value));
        }

        if ('@null' === $input) {
            return null;
        }

        if ($input instanceof \stdClass) {
            foreach (get_object_vars($input) as $key => $value) {
                $input->{$key} = self::cleanupNull($value);
            }
        }

        return $input;
    }
}
