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

final class Event
{
    public const SUPPORTED_TYPES = ['Event'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/event';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'startDate' => [
            'name' => 'startDate',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'endDate' => [
            'name' => 'endDate',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'location' => [
            'name' => 'location',
            'severity' => 'required',
            'supportedTypes' => [
                'Place',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
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
        'description' => [
            'name' => 'description',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'eventStatus' => [
            'name' => 'eventStatus',
            'severity' => 'recommended',
            'supportedTypes' => [
                'EventStatusType',
            ],
        ],
        'offers' => [
            'name' => 'offers',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Offer',
            ],
            'properties' => [
                'url' => [
                    'name' => 'url',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
                'price' => [
                    'name' => 'price',
                    'severity' => 'recommended',
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
                        'OfferItemCondition',
                    ],
                ],
                'validFrom' => [
                    'name' => 'validFrom',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'DateTime',
                    ],
                ],
            ],
        ],
        'organizer' => [
            'name' => 'organizer',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Organization',
                'Person',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
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
            ],
        ],
        'performer' => [
            'name' => 'performer',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Person',
                'PerformingGroup',
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
    ];
}
