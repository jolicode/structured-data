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

final class ProductGroup
{
    public const NAME = 'ProductGroup';
    public const SUPPORTED_TYPES = ['ProductGroup'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/product-variants';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
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
            'severity' => 'recommended',
            'supportedTypes' => [
                'AdultOrientedEnumeration',
            ],
        ],
        'variesBy' => [
            'name' => 'variesBy',
            'severity' => 'recommended',
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
            'severity' => 'recommended',
            'supportedTypes' => [
                'Product',
            ],
        ],
        'aggregateRating' => [
            'name' => 'aggregateRating',
            'severity' => 'recommended',
            'supportedTypes' => [
                'AggregateRating',
            ],
        ],
        'review' => [
            'name' => 'review',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Review',
            ],
        ],
    ];
}
