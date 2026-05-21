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

final class ProductMerchantListing extends Product
{
    public const NAME = 'ProductMerchantListing';
    public const SUPPORTED_TYPES = ['Product'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/merchant-listing';
    public const SUBTYPE = 'MerchantListing';
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.product.merchant_listing_price_positive'];
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
        'image' => [
            'name' => 'image',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
                'ImageObject',
            ],
        ],
        'offers' => [
            'name' => 'offers',
            'severity' => 'required',
            'supportedTypes' => [
                'Offer',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'price' => [
                        ],
                        'priceSpecification' => [
                        ],
                    ],
                ],
                'price' => [
                    'name' => 'price',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'priceCurrency' => [
                    'name' => 'priceCurrency',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
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
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                    ],
                ],
                'availability' => [
                    'name' => 'availability',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'ItemAvailability',
                    ],
                ],
                'shippingDetails' => [
                    'name' => 'shippingDetails',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'OfferShippingDetails',
                    ],
                ],
                'hasMerchantReturnPolicy' => [
                    'name' => 'hasMerchantReturnPolicy',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'MerchantReturnPolicy',
                    ],
                ],
            ],
        ],
    ];
}
