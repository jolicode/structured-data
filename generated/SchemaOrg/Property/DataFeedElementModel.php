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

final class DataFeedElementModel
{
    public const DESCRIPTION = 'An item within a data feed. Data feeds may have many elements.';
    public const LABEL = 'dataFeedElement';
    public const NAME = 'schema:dataFeedElement';
    public const VALUES = ['DataFeedItemModel' => 'SchemaOrg\Type\DataFeedItemModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['DataFeed' => 'SchemaOrg\Type\DataFeedModel'];
}
