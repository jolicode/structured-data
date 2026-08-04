<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class RecipeIngredientModel
{
    public const DESCRIPTION = 'An ingredient or ordered list of ingredients and potentially quantities used in the recipe, e.g. 1 cup of sugar, flour or garlic.  The ingredients can be represented as free text or more structured values.';
    public const LABEL = 'recipeIngredient';
    public const NAME = 'schema:recipeIngredient';
    public const VALUES = ['ItemListModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ItemListModel', 'PropertyValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Recipe' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
