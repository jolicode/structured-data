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
            'severity' => 'optional',
            'supportedTypes' => [
                'Review',
            ],
        ],
        'aggregateRating' => [
            'name' => 'aggregateRating',
            'severity' => 'optional',
            'supportedTypes' => [
                'AggregateRating',
            ],
        ],
        'offers' => [
            'name' => 'offers',
            'severity' => 'optional',
            'supportedTypes' => [
                'Offer',
                'AggregateOffer',
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
                'availability' => [
                    'name' => 'availability',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'ItemAvailability',
                    ],
                ],
                'priceValidUntil' => [
                    'name' => 'priceValidUntil',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Date',
                    ],
                ],
            ],
        ],
    ];
}
