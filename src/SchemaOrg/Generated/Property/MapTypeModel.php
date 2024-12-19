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

final class MapTypeModel
{
    public const DESCRIPTION = 'Indicates the kind of Map, from the MapCategoryType Enumeration.';
    public const LABEL = 'mapType';
    public const NAME = 'schema:mapType';
    public const VALUES = ['MapCategoryTypeModel' => 'Jolicode\SchemaOrg\Type\MapCategoryTypeModel'];
    public const TYPES = ['Map' => 'Jolicode\SchemaOrg\Type\MapModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
