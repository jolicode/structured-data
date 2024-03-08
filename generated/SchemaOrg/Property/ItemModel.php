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

final class ItemModel
{
    public const DESCRIPTION = 'An entity represented by an entry in a list or data feed (e.g. an \'artist\' in a list of \'artists\').';
    public const LABEL = 'item';
    public const NAME = 'schema:item';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['DataFeedItem' => 'SchemaOrg\\Type\\DataFeedItemModel', 'ListItem' => 'SchemaOrg\\Type\\ListItemModel'];
}
