<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Generator\SchemaOrg\Services;

class ClassTextBuilder
{
    public static function sanitizeClassName(string $name): string
    {
        return self::replaceStartNumbers($name);
    }

    public static function replaceStartNumbers(string $name): string
    {
        if (preg_match('/^(\d+).*$/', $name)) {
            $name = strtr($name, [
                '0' => 'Zero',
                '1' => 'One',
                '2' => 'Two',
                '3' => 'Three',
                '4' => 'Four',
                '5' => 'Five',
                '6' => 'Six',
                '7' => 'Seven',
                '8' => 'Eight',
                '9' => 'Nine',
            ]);
        }

        return $name;
    }
}
