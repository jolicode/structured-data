<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Parser;

/**
 * Columns are counted in UTF-16 code units, as editors running in a browser
 * (CodeMirror, Monaco) and JavaScript strings count them: a character outside
 * the Basic Multilingual Plane, such as most emoji, takes two columns.
 */
final class Utf16
{
    /**
     * The length of a UTF-8 string in UTF-16 code units.
     */
    public static function length(string $string): int
    {
        $length = mb_strlen($string, 'UTF-8');

        if ($length === \strlen($string)) {
            return $length;
        }

        // Each character outside the BMP is encoded on four bytes in UTF-8, led
        // by a byte from 0xF0 to 0xF4, and takes a surrogate pair in UTF-16.
        return $length + (int) preg_match_all('/[\xF0-\xF4]/', $string);
    }
}
