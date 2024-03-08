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

final class HasMenuModel
{
    public const DESCRIPTION = 'Either the actual menu as a structured representation, as text, or a URL of the menu.';
    public const LABEL = 'hasMenu';
    public const NAME = 'schema:hasMenu';
    public const VALUES = ['MenuModel' => 'SchemaOrg\Type\MenuModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'SchemaOrg\Type\FoodEstablishmentModel'];
}
