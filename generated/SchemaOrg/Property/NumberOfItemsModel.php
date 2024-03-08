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

final class NumberOfItemsModel
{
    public const DESCRIPTION = 'The number of items in an ItemList. Note that some descriptions might not fully describe all items in a list (e.g., multi-page pagination); in such cases, the numberOfItems would be for the entire list.';
    public const LABEL = 'numberOfItems';
    public const NAME = 'schema:numberOfItems';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['ItemList' => 'SchemaOrg\\Type\\ItemListModel'];
}
