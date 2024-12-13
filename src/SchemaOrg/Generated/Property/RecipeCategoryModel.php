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

final class RecipeCategoryModel
{
    public const DESCRIPTION = 'The category of the recipe—for example, appetizer, entree, etc.';
    public const LABEL = 'recipeCategory';
    public const NAME = 'schema:recipeCategory';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Recipe' => 'Jolicode\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
