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

final class HasMenuItemModel
{
    public const DESCRIPTION = 'A food or drink item contained in a menu or menu section.';
    public const LABEL = 'hasMenuItem';
    public const NAME = 'schema:hasMenuItem';
    public const VALUES = ['MenuItemModel' => 'SchemaOrg\\Type\\MenuItemModel'];
    public const TYPES = ['Menu' => 'SchemaOrg\\Type\\MenuModel', 'MenuSection' => 'SchemaOrg\\Type\\MenuSectionModel'];
}
