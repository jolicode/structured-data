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

final class ItemListOrderModel
{
    public const DESCRIPTION = 'Type of ordering (e.g. Ascending, Descending, Unordered).';
    public const LABEL = 'itemListOrder';
    public const NAME = 'schema:itemListOrder';
    public const VALUES = ['ItemListOrderTypeModel' => 'Jolicode\SchemaOrg\Type\ItemListOrderTypeModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ItemList' => 'Jolicode\SchemaOrg\Type\ItemListModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
