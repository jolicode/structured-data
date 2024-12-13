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

final class PositionModel
{
    public const DESCRIPTION = 'The position of an item in a series or sequence of items.';
    public const LABEL = 'position';
    public const NAME = 'schema:position';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'ListItem' => 'Jolicode\SchemaOrg\Type\ListItemModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
