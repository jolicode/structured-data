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

final class ItemList
{
    public const NAME = 'ItemList';
    public const SUPPORTED_TYPES = ['ItemList'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/carousel';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
        'itemListElement' => [
            'name' => 'itemListElement',
            'severity' => 'required',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/carousels-beta',
            'supportedTypes' => [
                'ListItem',
            ],
            'properties' => [
                'position' => [
                    'name' => 'position',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'url' => [
                        ],
                        'item' => [
                        ],
                    ],
                ],
                'item' => [
                    'name' => 'item',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Thing',
                    ],
                    'properties' => [
                        [
                            'name' => [
                                'name' => 'name',
                                'severity' => 'required',
                                'supportedTypes' => [
                                    'Text',
                                ],
                            ],
                            'url' => [
                                'name' => 'url',
                                'severity' => 'required',
                                'supportedTypes' => [
                                    'URL',
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Course',
                            'properties' => [
                                'description' => [
                                    'name' => 'description',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'provider' => [
                                    'name' => 'provider',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Organization',
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Movie',
                            'properties' => [
                                'image' => [
                                    'name' => 'image',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                        'ImageObject',
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Recipe',
                            'properties' => [
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
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'recipeInstructions' => [
                                    'name' => 'recipeInstructions',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'HowToStep',
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Restaurant',
                            'properties' => [
                                'image' => [
                                    'name' => 'image',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                        'ImageObject',
                                    ],
                                ],
                                'address' => [
                                    'name' => 'address',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'PostalAddress',
                                    ],
                                ],
                                'servesCuisine' => [
                                    'name' => 'servesCuisine',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
}
