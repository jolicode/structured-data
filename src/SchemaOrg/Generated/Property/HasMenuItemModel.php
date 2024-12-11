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

final class HasMenuItemModel
{
    public const DESCRIPTION = 'A food or drink item contained in a menu or menu section.';
    public const LABEL = 'hasMenuItem';
    public const NAME = 'schema:hasMenuItem';
    public const VALUES = ['MenuItemModel' => 'Jolicode\SchemaOrg\Type\MenuItemModel'];
    public const TYPES = ['Menu' => 'Jolicode\SchemaOrg\Type\MenuModel', 'MenuSection' => 'Jolicode\SchemaOrg\Type\MenuSectionModel'];
}
