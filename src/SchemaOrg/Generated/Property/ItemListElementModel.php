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

final class ItemListElementModel
{
    public const DESCRIPTION = 'For itemListElement values, you can use simple strings (e.g. "Peter", "Paul", "Mary"), existing entities, or use ListItem.\n\nText values are best if the elements in the list are plain strings. Existing entities are best for a simple, unordered list of existing things in your data. ListItem is used with ordered lists when you want to provide additional context about the element in that list or when the same item might be in different places in different lists.\n\nNote: The order of elements in your mark-up is not sufficient for indicating the order or elements.  Use ListItem with a \'position\' property in such cases.';
    public const LABEL = 'itemListElement';
    public const NAME = 'schema:itemListElement';
    public const VALUES = ['ListItemModel' => 'Jolicode\SchemaOrg\Type\ListItemModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['ItemList' => 'Jolicode\SchemaOrg\Type\ItemListModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
