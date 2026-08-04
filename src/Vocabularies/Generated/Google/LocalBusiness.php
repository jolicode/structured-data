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

final class LocalBusiness
{
    public const SUPPORTED_TYPES = ['LocalBusiness'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/local-business';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'address' => [
            'name' => 'address',
            'severity' => 'required',
            'supportedTypes' => [
                'PostalAddress',
            ],
            'properties' => [
                'streetAddress' => [
                    'name' => 'streetAddress',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'addressLocality' => [
                    'name' => 'addressLocality',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'addressRegion' => [
                    'name' => 'addressRegion',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'postalCode' => [
                    'name' => 'postalCode',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'addressCountry' => [
                    'name' => 'addressCountry',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'geo' => [
            'name' => 'geo',
            'severity' => 'recommended',
            'supportedTypes' => [
                'GeoCoordinates',
            ],
            'properties' => [
                'latitude' => [
                    'name' => 'latitude',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'longitude' => [
                    'name' => 'longitude',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
            ],
        ],
        'menu' => [
            'name' => 'menu',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'openingHoursSpecification' => [
            'name' => 'openingHoursSpecification',
            'severity' => 'recommended',
            'supportedTypes' => [
                'OpeningHoursSpecification',
            ],
            'properties' => [
                'dayOfWeek' => [
                    'name' => 'dayOfWeek',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'DayOfWeek',
                    ],
                ],
                'opens' => [
                    'name' => 'opens',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Time',
                    ],
                ],
                'closes' => [
                    'name' => 'closes',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Time',
                    ],
                ],
                'validFrom' => [
                    'name' => 'validFrom',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Date',
                    ],
                ],
                'validThrough' => [
                    'name' => 'validThrough',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Date',
                    ],
                ],
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
        'telephone' => [
            'name' => 'telephone',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
    ];
}
