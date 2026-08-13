<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\JsonLd;

enum FramingKeyword: string
{
    case DEFAULT = '@default';
    case EMBED = '@embed';
    case EXPLICIT = '@explicit';
    case OMIT_DEFAULT = '@omitDefault';
    case REQUIRE_ALL = '@requireAll';
    case TYPE = '@type';
    case VALUE = '@value';
    case LIST = '@list';
    case ID = '@id';
    case INDEX = '@index';
    case REVERSE = '@reverse';
    case GRAPH = '@graph';
    case INCLUDED = '@included';
}
