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
    case FRAME = 'frame';

    /**
     * The list of algorithms that are part of the official test suite.
     * Other algorithms are handled in a different way.
     * see https://github.com/w3c/json-ld-api/tree/main/tests.
     *
     * @return array<string>
     */
    public static function algorithmNames(): array
    {
        return [
            self::FLATTEN->value,
            self::COMPACT->value,
            self::EXPAND->value,
        ];
    }
}
