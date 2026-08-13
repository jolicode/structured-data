<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class RecipeIngredientModel
{
    public const DESCRIPTION = 'An ingredient or ordered list of ingredients and potentially quantities used in the recipe, e.g. 1 cup of sugar, flour or garlic.  The ingredients can be represented as free text or more structured values.';
    public const LABEL = 'recipeIngredient';
    public const NAME = 'schema:recipeIngredient';
    public const VALUES = ['ItemListModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ItemListModel', 'PropertyValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Recipe' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RecipeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
