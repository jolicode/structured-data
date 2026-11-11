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

final class ItemList
{
    public const SUPPORTED_TYPES = ['ItemList'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/carousel';
    public const SPECIAL_RULE_KEYS = [];
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
                        'url' => true,
                        'item' => true,
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
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'provider' => [
                                    'name' => 'provider',
                                    'severity' => 'recommended',
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
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'PostalAddress',
                                    ],
                                ],
                                'servesCuisine' => [
                                    'name' => 'servesCuisine',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'LocalBusiness',
                            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/carousels-beta',
                            'properties' => [
                                'image' => [
                                    'name' => 'image',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                        'ImageObject',
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
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                                'Text',
                                            ],
                                        ],
                                        'ratingCount' => [
                                            'name' => 'ratingCount',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'bestRating' => [
                                            'name' => 'bestRating',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                    ],
                                ],
                                'amenityFeature' => [
                                    'name' => 'amenityFeature',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'LocationFeatureSpecification',
                                    ],
                                ],
                                'priceRange' => [
                                    'name' => 'priceRange',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'servesCuisine' => [
                                    'name' => 'servesCuisine',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Product',
                            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/carousels-beta',
                            'properties' => [
                                'image' => [
                                    'name' => 'image',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                        'ImageObject',
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
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                                'Text',
                                            ],
                                        ],
                                        'ratingCount' => [
                                            'name' => 'ratingCount',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'bestRating' => [
                                            'name' => 'bestRating',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                    ],
                                ],
                                'offers' => [
                                    'name' => 'offers',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Offer',
                                        'AggregateOffer',
                                    ],
                                    'properties' => [
                                        'atLeastOneOf' => [
                                            'name' => 'atLeastOneOf',
                                            'severity' => 'recommended',
                                            'value' => [
                                                'price' => true,
                                                'lowPrice' => true,
                                            ],
                                            'supportedTypes' => [
                                            ],
                                        ],
                                        'price' => [
                                            'name' => 'price',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'lowPrice' => [
                                            'name' => 'lowPrice',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'highPrice' => [
                                            'name' => 'highPrice',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'priceCurrency' => [
                                            'name' => 'priceCurrency',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            '@target' => 'Event',
                            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/carousels-beta',
                            'properties' => [
                                'image' => [
                                    'name' => 'image',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                        'ImageObject',
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
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                                'Text',
                                            ],
                                        ],
                                        'ratingCount' => [
                                            'name' => 'ratingCount',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'bestRating' => [
                                            'name' => 'bestRating',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                    ],
                                ],
                                'offers' => [
                                    'name' => 'offers',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Offer',
                                        'AggregateOffer',
                                    ],
                                    'properties' => [
                                        'atLeastOneOf' => [
                                            'name' => 'atLeastOneOf',
                                            'severity' => 'recommended',
                                            'value' => [
                                                'price' => true,
                                                'lowPrice' => true,
                                            ],
                                            'supportedTypes' => [
                                            ],
                                        ],
                                        'price' => [
                                            'name' => 'price',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'lowPrice' => [
                                            'name' => 'lowPrice',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'highPrice' => [
                                            'name' => 'highPrice',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'priceCurrency' => [
                                            'name' => 'priceCurrency',
                                            'severity' => 'recommended',
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
            ],
        ],
    ];
}
