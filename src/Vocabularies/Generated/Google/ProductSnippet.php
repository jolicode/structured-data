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

final class ProductSnippet extends Product
{
    public const SUPPORTED_TYPES = ['Product'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/product-snippet';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'review' => true,
                'aggregateRating' => true,
                'offers' => true,
            ],
        ],
        'review' => [
            'name' => 'review',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Review',
            ],
            'properties' => [
                'positiveNotes' => [
                    'name' => 'positiveNotes',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ItemList',
                    ],
                    'properties' => [
                        'itemListElement' => [
                            'name' => 'itemListElement',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'ListItem',
                            ],
                            'properties' => [
                                'name' => [
                                    'name' => 'name',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'position' => [
                                    'name' => 'position',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Integer',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'negativeNotes' => [
                    'name' => 'negativeNotes',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ItemList',
                    ],
                    'properties' => [
                        'itemListElement' => [
                            'name' => 'itemListElement',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'ListItem',
                            ],
                            'properties' => [
                                'name' => [
                                    'name' => 'name',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'position' => [
                                    'name' => 'position',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Integer',
                                    ],
                                ],
                            ],
                        ],
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
        ],
        'offers' => [
            'name' => 'offers',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Offer',
                'AggregateOffer',
            ],
            'properties' => [
                [
                    '@target' => 'Offer',
                    'properties' => [
                        'atLeastOneOf' => [
                            'name' => 'atLeastOneOf',
                            'severity' => 'required',
                            'value' => [
                                'price' => true,
                                'priceSpecification' => true,
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
                        'priceSpecification' => [
                            'name' => 'priceSpecification',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'UnitPriceSpecification',
                            ],
                            'properties' => [
                                'price' => [
                                    'name' => 'price',
                                    'severity' => 'required',
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
                        'atLeastOneOfPriceCurrency' => [
                            'name' => 'atLeastOneOf',
                            'severity' => 'recommended',
                            'value' => [
                                'priceCurrency' => true,
                                'priceSpecification' => true,
                            ],
                            'supportedTypes' => [
                            ],
                        ],
                        'priceCurrency' => [
                            'name' => 'priceCurrency',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'availability' => [
                            'name' => 'availability',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'ItemAvailability',
                            ],
                        ],
                        'priceValidUntil' => [
                            'name' => 'priceValidUntil',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'Date',
                            ],
                        ],
                    ],
                ],
                [
                    '@target' => 'AggregateOffer',
                    'properties' => [
                        'lowPrice' => [
                            'name' => 'lowPrice',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Number',
                            ],
                        ],
                        'priceCurrency' => [
                            'name' => 'priceCurrency',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'highPrice' => [
                            'name' => 'highPrice',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Number',
                            ],
                        ],
                        'offerCount' => [
                            'name' => 'offerCount',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Number',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
}
