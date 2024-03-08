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

final class DateDeletedModel
{
    public const DESCRIPTION = 'The datetime the item was removed from the DataFeed.';
    public const LABEL = 'dateDeleted';
    public const NAME = 'schema:dateDeleted';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['DataFeedItem' => 'SchemaOrg\\Type\\DataFeedItemModel'];
}
