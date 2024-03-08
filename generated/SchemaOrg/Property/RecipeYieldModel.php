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

final class RecipeYieldModel
{
    public const DESCRIPTION = 'The quantity produced by the recipe (for example, number of people served, number of servings, etc).';
    public const LABEL = 'recipeYield';
    public const NAME = 'schema:recipeYield';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Recipe' => 'SchemaOrg\\Type\\RecipeModel'];
}
