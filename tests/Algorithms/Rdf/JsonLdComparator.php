<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Rdf;

/**
 * Compares two decoded JSON-LD documents the way the W3C test suite asks a
 * fromRdf result to be compared: the order of an array only matters inside a
 * list, since an RDF dataset has no order to give to anything else.
 */
final class JsonLdComparator
{
    public static function areEquivalent(mixed $expected, mixed $actual, bool $ordered = false): bool
    {
        if ($expected instanceof \stdClass && $actual instanceof \stdClass) {
            $expectedEntries = get_object_vars($expected);
            $actualEntries = get_object_vars($actual);

            if (\count($expectedEntries) !== \count($actualEntries)) {
                return false;
            }

            foreach ($expectedEntries as $key => $value) {
                if (!\array_key_exists($key, $actualEntries) || !self::areEquivalent($value, $actualEntries[$key], '@list' === (string) $key)) {
                    return false;
                }
            }

            return true;
        }

        if (\is_array($expected) && \is_array($actual)) {
            if (\count($expected) !== \count($actual)) {
                return false;
            }

            $expected = array_values($expected);
            $remaining = array_values($actual);

            if ($ordered) {
                foreach ($expected as $index => $value) {
                    if (!self::areEquivalent($value, $remaining[$index])) {
                        return false;
                    }
                }

                return true;
            }

            foreach ($expected as $value) {
                foreach ($remaining as $index => $candidate) {
                    if (self::areEquivalent($value, $candidate)) {
                        unset($remaining[$index]);

                        continue 2;
                    }
                }

                return false;
            }

            return true;
        }

        if ((\is_int($expected) || \is_float($expected)) && (\is_int($actual) || \is_float($actual))) {
            return (float) $expected === (float) $actual;
        }

        return $expected === $actual;
    }
}
