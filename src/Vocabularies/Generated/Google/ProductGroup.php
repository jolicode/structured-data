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

final class ProductGroup
{
    public const SUPPORTED_TYPES = ['ProductGroup'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/product-variants';
    public const SPECIAL_RULE_KEYS = [];
    public const STANDALONE = true;
    public const ACCEPTS_SUBTYPES = true;
    public const EXCLUDED_SUBTYPES = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'hasAdultConsideration' => [
            'name' => 'hasAdultConsideration',
            'severity' => 'optional',
            'supportedTypes' => [
                'AdultOrientedEnumeration',
            ],
        ],
        'variesBy' => [
            'name' => 'variesBy',
            'severity' => 'optional',
            'supportedTypes' => [
                'DefinedTerm',
            ],
        ],
        'productGroupID' => [
            'name' => 'productGroupID',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'hasVariant' => [
            'name' => 'hasVariant',
            'severity' => 'optional',
            'supportedTypes' => [
                'Product',
            ],
        ],
        'aggregateRating' => [
            'name' => 'aggregateRating',
            'severity' => 'optional',
            'supportedTypes' => [
                'AggregateRating',
            ],
        ],
        'review' => [
            'name' => 'review',
            'severity' => 'optional',
            'supportedTypes' => [
                'Review',
            ],
        ],
        'brand' => [
            'name' => 'brand',
            'severity' => 'optional',
            'supportedTypes' => [
                'Brand',
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
        'description' => [
            'name' => 'description',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
                'TextObject',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
            ],
        ],
    ];
}
