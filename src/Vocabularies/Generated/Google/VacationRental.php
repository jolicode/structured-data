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

final class VacationRental
{
    public const SUPPORTED_TYPES = ['VacationRental'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/vacation-rental';
    public const SPECIAL_RULE_KEYS = [];
    public const STANDALONE = true;
    public const ACCEPTS_SUBTYPES = true;
    public const EXCLUDED_SUBTYPES = [];
    public const PROPERTIES = [
        'containsPlace' => [
            'name' => 'containsPlace',
            'severity' => 'required',
            'supportedTypes' => [
                'Accommodation',
            ],
            'properties' => [
                'occupancy' => [
                    'name' => 'occupancy',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'QuantitativeValue',
                    ],
                    'properties' => [
                        'value' => [
                            'name' => 'value',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Integer',
                            ],
                        ],
                    ],
                ],
                'additionalType' => [
                    'name' => 'additionalType',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'numberOfBedrooms' => [
                    'name' => 'numberOfBedrooms',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'numberOfBathroomsTotal' => [
                    'name' => 'numberOfBathroomsTotal',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'numberOfRooms' => [
                    'name' => 'numberOfRooms',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'amenityFeature' => [
                    'name' => 'amenityFeature',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'LocationFeatureSpecification',
                    ],
                    'properties' => [
                        'name' => [
                            'name' => 'name',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'value' => [
                            'name' => 'value',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Boolean',
                                'Text',
                            ],
                        ],
                    ],
                ],
                'bed' => [
                    'name' => 'bed',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'BedDetails',
                    ],
                    'properties' => [
                        'numberOfBeds' => [
                            'name' => 'numberOfBeds',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Integer',
                            ],
                        ],
                        'typeOfBed' => [
                            'name' => 'typeOfBed',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                    ],
                ],
                'floorSize' => [
                    'name' => 'floorSize',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'QuantitativeValue',
                    ],
                    'properties' => [
                        'value' => [
                            'name' => 'value',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Number',
                            ],
                        ],
                        'unitCode' => [
                            'name' => 'unitCode',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'identifier' => [
            'name' => 'identifier',
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
            ],
        ],
        'atLeastOneOfLatitude' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'latitude' => true,
                'geo' => true,
            ],
            'supportedTypes' => [
            ],
        ],
        'latitude' => [
            'name' => 'latitude',
            'severity' => 'optional',
            'supportedTypes' => [
                'Number',
            ],
        ],
        'atLeastOneOfLongitude' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'longitude' => true,
                'geo' => true,
            ],
            'supportedTypes' => [
            ],
        ],
        'longitude' => [
            'name' => 'longitude',
            'severity' => 'optional',
            'supportedTypes' => [
                'Number',
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'address' => [
            'name' => 'address',
            'severity' => 'recommended',
            'supportedTypes' => [
                'PostalAddress',
            ],
            'properties' => [
                'addressCountry' => [
                    'name' => 'addressCountry',
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
                'streetAddress' => [
                    'name' => 'streetAddress',
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
            'properties' => [
                'contentReferenceTime' => [
                    'name' => 'contentReferenceTime',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'DateTime',
                    ],
                ],
            ],
        ],
        'brand' => [
            'name' => 'brand',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Brand',
            ],
        ],
        'additionalType' => [
            'name' => 'additionalType',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'checkinTime' => [
            'name' => 'checkinTime',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Time',
            ],
        ],
        'checkoutTime' => [
            'name' => 'checkoutTime',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Time',
            ],
        ],
        'knowsLanguage' => [
            'name' => 'knowsLanguage',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'geo' => [
            'name' => 'geo',
            'severity' => 'optional',
            'supportedTypes' => [
                'GeoCoordinates',
            ],
            'properties' => [
                'latitude' => [
                    'name' => 'latitude',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'longitude' => [
                    'name' => 'longitude',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
            ],
        ],
    ];
}
