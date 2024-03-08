<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DateCreatedModel
{
    public const DESCRIPTION = 'The date on which the CreativeWork was created or the item was added to a DataFeed.';
    public const LABEL = 'dateCreated';
    public const NAME = 'schema:dateCreated';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'DataFeedItem' => 'SchemaOrg\Type\DataFeedItemModel'];
}
