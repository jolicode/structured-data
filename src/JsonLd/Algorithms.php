<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd;

enum Algorithms: string
{
    case CONTEXT = 'context';
    case FLATTEN = 'flatten';
    case COMPACT = 'compact';
    case EXPAND = 'expand';

    // This only includes algorithms with a directory in the official test suite
    // see https://github.com/w3c/json-ld-api/tree/main/tests
    // Other algorithms are handled in a different way.
    public static function algorithms(): array
    {
        return [
            self::FLATTEN,
            self::COMPACT,
            self::EXPAND,
        ];
    }
}
