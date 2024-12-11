<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class QueryModel
{
    public const DESCRIPTION = 'A sub property of instrument. The query used on this action.';
    public const LABEL = 'query';
    public const NAME = 'schema:query';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SearchAction' => 'Jolicode\SchemaOrg\Type\SearchActionModel'];
}
