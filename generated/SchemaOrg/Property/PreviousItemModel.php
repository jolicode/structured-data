<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PreviousItemModel
{
    public const DESCRIPTION = 'A link to the ListItem that precedes the current one.';
    public const LABEL = 'previousItem';
    public const NAME = 'schema:previousItem';
    public const VALUES = ['ListItemModel' => 'SchemaOrg\\Type\\ListItemModel'];
    public const TYPES = ['ListItem' => 'SchemaOrg\\Type\\ListItemModel'];
}
