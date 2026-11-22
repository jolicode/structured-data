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

/**
 * The canonical lexical forms a native JSON value takes once it becomes an RDF
 * literal.
 *
 * see https://www.w3.org/TR/json-ld11-api/#data-round-tripping
 */
final class CanonicalLexicalForm
{
    public static function boolean(bool $value): string
    {
        return $value ? 'true' : 'false';
    }

    /**
     * The canonical lexical form of an xsd:integer: no fraction, no exponent.
     */
    public static function integer(int|float $value): string
    {
        if (\is_int($value)) {
            return (string) $value;
        }

        $integer = \sprintf('%.0F', $value);

        return '-0' === $integer ? '0' : $integer;
    }

    /**
     * The canonical lexical form of an xsd:double: one digit before the point,
     * at least one after, and an exponent without sign nor leading zero.
     */
    public static function double(int|float $value): string
    {
        $value = (float) $value;

        if (is_nan($value)) {
            return 'NaN';
        }

        if (is_infinite($value)) {
            return $value > 0 ? 'INF' : '-INF';
        }

        if (1 !== preg_match('/^(-?\d)\.(\d+)E([+-])(\d+)$/', \sprintf('%1.15E', $value), $matches)) {
            return (string) $value;
        }

        $fraction = rtrim($matches[2], '0');
        $exponent = ltrim($matches[4], '0');

        return \sprintf(
            '%s.%sE%s%s',
            $matches[1],
            '' === $fraction ? '0' : $fraction,
            '-' === $matches[3] && '' !== $exponent ? '-' : '',
            '' === $exponent ? '0' : $exponent,
        );
    }

    /**
     * Whether a number is written as an xsd:double rather than an xsd:integer
     * when nothing says which: it has a fraction, or is too large to be read
     * back as an integer.
     */
    public static function isDouble(int|float $value): bool
    {
        if (\is_int($value)) {
            return false;
        }

        return !is_finite($value) || 0.0 !== fmod($value, 1.0) || abs($value) >= 1.0E21;
    }
}
