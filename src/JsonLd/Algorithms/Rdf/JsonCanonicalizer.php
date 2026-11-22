<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;

/**
 * The JSON Canonicalization Scheme (RFC 8785), which gives a JSON literal its
 * lexical form.
 *
 * It expects a value decoded by json_decode() without the "assoc" flag: a JSON
 * object is a \stdClass, which is what tells an empty object from an empty
 * array.
 *
 * see https://www.rfc-editor.org/rfc/rfc8785
 */
final class JsonCanonicalizer
{
    public static function canonicalize(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (\is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (\is_int($value)) {
            return (string) $value;
        }

        if (\is_float($value)) {
            return self::number($value);
        }

        if (\is_string($value)) {
            return self::string($value);
        }

        if (\is_array($value)) {
            return '[' . implode(',', array_map(self::canonicalize(...), $value)) . ']';
        }

        if ($value instanceof \stdClass) {
            $members = [];

            foreach (get_object_vars($value) as $key => $member) {
                $members[(string) $key] = $member;
            }

            uksort($members, static fn (int|string $a, int|string $b): int => strcmp(
                mb_convert_encoding((string) $a, 'UTF-16BE', 'UTF-8'),
                mb_convert_encoding((string) $b, 'UTF-16BE', 'UTF-8'),
            ));

            $serialized = [];

            foreach ($members as $key => $member) {
                $serialized[] = self::string((string) $key) . ':' . self::canonicalize($member);
            }

            return '{' . implode(',', $serialized) . '}';
        }

        throw new JsonLdException('invalid JSON literal');
    }

    private static function string(string $value): string
    {
        $encoded = json_encode($value, \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_LINE_TERMINATORS);

        if (false === $encoded) {
            throw new JsonLdException('invalid JSON literal');
        }

        return $encoded;
    }

    /**
     * Number serialization as ECMAScript does it: the shortest digits that read
     * back as the same double, in decimal notation between 1e-6 and 1e21.
     */
    private static function number(float $value): string
    {
        if (!is_finite($value)) {
            throw new JsonLdException('invalid JSON literal');
        }

        if (0.0 === $value) {
            return '0';
        }

        $sign = $value < 0 ? '-' : '';
        $absolute = abs($value);
        $representation = \sprintf('%.16e', $absolute);

        for ($precision = 0; $precision < 16; ++$precision) {
            $candidate = \sprintf('%.' . $precision . 'e', $absolute);

            if ((float) $candidate === $absolute) {
                $representation = $candidate;

                break;
            }
        }

        [$mantissa, $exponent] = explode('e', $representation);
        $digits = rtrim(str_replace('.', '', $mantissa), '0');
        $digits = '' === $digits ? '0' : $digits;
        $digitCount = \strlen($digits);
        $pointPosition = (int) $exponent + 1;

        if ($digitCount <= $pointPosition && $pointPosition <= 21) {
            return $sign . $digits . str_repeat('0', $pointPosition - $digitCount);
        }

        if (0 < $pointPosition && $pointPosition <= 21) {
            return $sign . substr($digits, 0, $pointPosition) . '.' . substr($digits, $pointPosition);
        }

        if (-6 < $pointPosition && $pointPosition <= 0) {
            return $sign . '0.' . str_repeat('0', -$pointPosition) . $digits;
        }

        $power = $pointPosition - 1;

        return $sign . $digits[0] . ($digitCount > 1 ? '.' . substr($digits, 1) : '')
            . 'e' . ($power < 0 ? '-' : '+') . abs($power);
    }
}
