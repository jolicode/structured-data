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

final class MenuModel
{
    public const DESCRIPTION = 'Either the actual menu as a structured representation, as text, or a URL of the menu.';
    public const LABEL = 'menu';
    public const NAME = 'schema:menu';
    public const VALUES = ['MenuModel' => 'Jolicode\SchemaOrg\Type\MenuModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'Jolicode\SchemaOrg\Type\FoodEstablishmentModel'];
}
