<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class Recipe
{
    public const NAME = 'Recipe';
    public const SUPPORTED_TYPES = ['Recipe'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/recipe';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.recipe.calories_requires_yield'];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'image' => ['name' => 'image', 'severity' => 'required', 'supportedTypes' => ['URL', 'ImageObject']], 'recipeIngredient' => ['name' => 'recipeIngredient', 'severity' => 'required', 'supportedTypes' => ['Text']], 'recipeInstructions' => ['name' => 'recipeInstructions', 'severity' => 'required', 'supportedTypes' => ['HowToStep', 'Text'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'text' => ['name' => 'text', 'severity' => 'required', 'supportedTypes' => ['Text']]]], 'author' => ['name' => 'author', 'severity' => 'recommended', 'supportedTypes' => ['Person', 'Organization'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]], 'prepTime' => ['name' => 'prepTime', 'severity' => 'recommended', 'supportedTypes' => ['Duration']], 'cookTime' => ['name' => 'cookTime', 'severity' => 'recommended', 'supportedTypes' => ['Duration']], 'totalTime' => ['name' => 'totalTime', 'severity' => 'recommended', 'supportedTypes' => ['Duration']], 'description' => ['name' => 'description', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'datePublished' => ['name' => 'datePublished', 'severity' => 'recommended', 'supportedTypes' => ['Date']], 'keywords' => ['name' => 'keywords', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'recipeCuisine' => ['name' => 'recipeCuisine', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'recipeCategory' => ['name' => 'recipeCategory', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'recipeYield' => ['name' => 'recipeYield', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'Number']], 'nutrition' => ['name' => 'nutrition', 'severity' => 'recommended', 'supportedTypes' => ['NutritionInformation'], 'properties' => ['calories' => ['name' => 'calories', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'Number']]]], 'aggregateRating' => ['name' => 'aggregateRating', 'severity' => 'recommended', 'supportedTypes' => ['AggregateRating'], 'properties' => ['ratingValue' => ['name' => 'ratingValue', 'severity' => 'required', 'supportedTypes' => ['Number', 'Text']], 'ratingCount' => ['name' => 'ratingCount', 'severity' => 'required', 'supportedTypes' => ['Integer']]]]];
}
