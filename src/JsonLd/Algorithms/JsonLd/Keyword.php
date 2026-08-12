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

enum Keyword: string
{
    case BASE = '@base';
    case CONTAINER = '@container';
    case CONTEXT = '@context';
    case DIRECTION = '@direction';
    case GRAPH = '@graph';
    case ID = '@id';
    case IMPORT = '@import';
    case INCLUDED = '@included';
    case INDEX = '@index';
    case JSON = '@json';
    case LANGUAGE = '@language';
    case LIST = '@list';
    case NEST = '@nest';
    case NONE = '@none';
    case PREFIX = '@prefix';
    case PROPAGATE = '@propagate';
    case PROTECTED = '@protected';
    case REVERSE = '@reverse';
    case SET = '@set';
    case TYPE = '@type';
    case VALUE = '@value';
    case VERSION = '@version';
    case VOCAB = '@vocab';
}
