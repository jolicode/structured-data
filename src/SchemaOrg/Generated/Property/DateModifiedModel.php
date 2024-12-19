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

final class DateModifiedModel
{
    public const DESCRIPTION = 'The date on which the CreativeWork was most recently modified or when the item\'s entry was modified within a DataFeed.';
    public const LABEL = 'dateModified';
    public const NAME = 'schema:dateModified';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'DataFeedItem' => 'Jolicode\SchemaOrg\Type\DataFeedItemModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
