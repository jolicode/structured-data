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

final class NextItemModel
{
    public const DESCRIPTION = 'A link to the ListItem that follows the current one.';
    public const LABEL = 'nextItem';
    public const NAME = 'schema:nextItem';
    public const VALUES = ['ListItemModel' => 'Jolicode\SchemaOrg\Type\ListItemModel'];
    public const TYPES = ['ListItem' => 'Jolicode\SchemaOrg\Type\ListItemModel'];
}
