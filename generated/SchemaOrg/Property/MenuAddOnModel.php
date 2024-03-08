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

final class MenuAddOnModel
{
    public const DESCRIPTION = 'Additional menu item(s) such as a side dish of salad or side order of fries that can be added to this menu item. Additionally it can be a menu section containing allowed add-on menu items for this menu item.';
    public const LABEL = 'menuAddOn';
    public const NAME = 'schema:menuAddOn';
    public const VALUES = ['MenuItemModel' => 'SchemaOrg\\Type\\MenuItemModel', 'MenuSectionModel' => 'SchemaOrg\\Type\\MenuSectionModel'];
    public const TYPES = ['MenuItem' => 'SchemaOrg\\Type\\MenuItemModel'];
}
