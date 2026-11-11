<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\Google;

final class Recipe
{
    public const SUPPORTED_TYPES = ['Recipe'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/recipe';
    public const SPECIAL_RULE_KEYS = ['google.recipe.calories_requires_yield'];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'image' => [
            'name' => 'image',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
                'ImageObject',
            ],
        ],
        'recipeIngredient' => [
            'name' => 'recipeIngredient',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'recipeInstructions' => [
            'name' => 'recipeInstructions',
            'severity' => 'recommended',
            'supportedTypes' => [
                'HowToStep',
                'HowToSection',
                'Text',
            ],
            'properties' => [
                [
                    '@target' => 'HowToStep',
                    'properties' => [
                        'text' => [
                            'name' => 'text',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'name' => [
                            'name' => 'name',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'image' => [
                            'name' => 'image',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'URL',
                                'ImageObject',
                            ],
                        ],
                        'url' => [
                            'name' => 'url',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'URL',
                            ],
                        ],
                        'video' => [
                            'name' => 'video',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'VideoObject',
                            ],
                        ],
                    ],
                ],
                [
                    '@target' => 'HowToSection',
                    'properties' => [
                        'name' => [
                            'name' => 'name',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'itemListElement' => [
                            'name' => 'itemListElement',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'HowToStep',
                                'HowToDirection',
                                'HowToTip',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'author' => [
            'name' => 'author',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Person',
                'Organization',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'prepTime' => [
            'name' => 'prepTime',
            'severity' => 'optional',
            'supportedTypes' => [
                'Duration',
            ],
        ],
        'cookTime' => [
            'name' => 'cookTime',
            'severity' => 'optional',
            'supportedTypes' => [
                'Duration',
            ],
        ],
        'totalTime' => [
            'name' => 'totalTime',
            'severity' => 'optional',
            'supportedTypes' => [
                'Duration',
            ],
        ],
        'description' => [
            'name' => 'description',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'datePublished' => [
            'name' => 'datePublished',
            'severity' => 'optional',
            'supportedTypes' => [
                'Date',
            ],
        ],
        'keywords' => [
            'name' => 'keywords',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'recipeCuisine' => [
            'name' => 'recipeCuisine',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'recipeCategory' => [
            'name' => 'recipeCategory',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'recipeYield' => [
            'name' => 'recipeYield',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
                'Number',
            ],
        ],
        'nutrition' => [
            'name' => 'nutrition',
            'severity' => 'recommended',
            'supportedTypes' => [
                'NutritionInformation',
            ],
            'properties' => [
                'calories' => [
                    'name' => 'calories',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                        'Number',
                    ],
                ],
            ],
        ],
        'aggregateRating' => [
            'name' => 'aggregateRating',
            'severity' => 'recommended',
            'supportedTypes' => [
                'AggregateRating',
            ],
            'properties' => [
                'ratingValue' => [
                    'name' => 'ratingValue',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                        'Text',
                    ],
                ],
                'ratingCount' => [
                    'name' => 'ratingCount',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
            ],
        ],
        'video' => [
            'name' => 'video',
            'severity' => 'recommended',
            'supportedTypes' => [
                'VideoObject',
            ],
        ],
    ];
}
