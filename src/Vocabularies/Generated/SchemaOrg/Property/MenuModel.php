<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class MenuModel
{
    public const DESCRIPTION = 'Either the actual menu as a structured representation, as text, or a URL of the menu.';
    public const LABEL = 'menu';
    public const NAME = 'schema:menu';
    public const VALUES = ['MenuModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['FoodEstablishment' => 'Jolicode\Vocabularies\SchemaOrg\Type\FoodEstablishmentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
