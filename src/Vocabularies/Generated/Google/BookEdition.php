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

final class BookEdition extends Book
{
    public const NAME = 'BookEdition';
    public const SUPPORTED_TYPES = ['Book'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/book#book-edition';
    public const SUBTYPE = 'Edition';
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.book.offer_pricing_by_category'];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
        '@id' => [
            'name' => '@id',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'bookFormat' => [
            'name' => 'bookFormat',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
            'value' => [
                'https://schema.org/AudiobookFormat',
                'https://schema.org/EBook',
                'https://schema.org/Hardcover',
                'https://schema.org/Paperback',
            ],
        ],
        'inLanguage' => [
            'name' => 'inLanguage',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'isbn' => [
            'name' => 'isbn',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'potentialAction' => [
            'name' => 'potentialAction',
            'severity' => 'required',
            'supportedTypes' => [
                'ReadAction',
                'BorrowAction',
            ],
            'properties' => [
                [
                    '@target' => 'ReadAction',
                    'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#readaction-potentialaction',
                    'properties' => [
                        'expectsAcceptanceOf' => [
                            'name' => 'expectsAcceptanceOf',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Offer',
                            ],
                            'properties' => [
                                'category' => [
                                    'name' => 'category',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                    'value' => [
                                        'nologinrequired',
                                        'free',
                                        'subscription',
                                        'purchase',
                                        'rental',
                                    ],
                                ],
                                'eligibleRegion' => [
                                    'name' => 'eligibleRegion',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Country',
                                    ],
                                    'properties' => [
                                        'name' => [
                                            'name' => 'name',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                        ],
                                    ],
                                ],
                                'availabilityEnds' => [
                                    'name' => 'availabilityEnds',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'DateTime',
                                    ],
                                ],
                                'availabilityStarts' => [
                                    'name' => 'availabilityStarts',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'DateTime',
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
                            ],
                        ],
                        'target' => [
                            'name' => 'target',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'EntryPoint',
                            ],
                            'properties' => [
                                'actionPlatform' => [
                                    'name' => 'actionPlatform',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                    'value' => [
                                        'https://schema.org/DesktopWebPlatform',
                                        'https://schema.org/AndroidPlatform',
                                        'https://schema.org/IOSPlatform',
                                    ],
                                ],
                                'urlTemplate' => [
                                    'name' => 'urlTemplate',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    '@target' => 'BorrowAction',
                    'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#borrowaction-potentialaction',
                    'properties' => [
                        'lender' => [
                            'name' => 'lender',
                            'severity' => 'required',
                            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#library-entity',
                            'supportedTypes' => [
                                'LibrarySystem',
                            ],
                            'properties' => [
                                '@id' => [
                                    'name' => '@id',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                    ],
                                ],
                                'additionalProperty' => [
                                    'name' => 'additionalProperty',
                                    'severity' => 'required',
                                    'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#propertyvalue-identifier',
                                    'supportedTypes' => [
                                        'PropertyValue',
                                    ],
                                    'properties' => [
                                        'name' => [
                                            'name' => 'name',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                            'value' => [
                                                'librarytype',
                                            ],
                                        ],
                                        'value' => [
                                            'name' => 'value',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                            'value' => [
                                                'public',
                                                'academic',
                                                'corporate',
                                                'government',
                                                'school',
                                                'special',
                                            ],
                                        ],
                                    ],
                                ],
                                'url' => [
                                    'name' => 'url',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                    ],
                                ],
                                'member' => [
                                    'name' => 'member',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Library',
                                    ],
                                    'properties' => [
                                        '@id' => [
                                            'name' => '@id',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'URL',
                                            ],
                                        ],
                                        'location' => [
                                            'name' => 'location',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'PostalAddress',
                                            ],
                                            'properties' => [
                                                'addressCountry' => [
                                                    'name' => 'addressCountry',
                                                    'severity' => 'required',
                                                    'supportedTypes' => [
                                                        'Text',
                                                    ],
                                                ],
                                                'addressLocality' => [
                                                    'name' => 'addressLocality',
                                                    'severity' => 'required',
                                                    'supportedTypes' => [
                                                        'Text',
                                                    ],
                                                ],
                                                'addressRegion' => [
                                                    'name' => 'addressRegion',
                                                    'severity' => 'required',
                                                    'supportedTypes' => [
                                                        'Text',
                                                    ],
                                                ],
                                                'postalCode' => [
                                                    'name' => 'postalCode',
                                                    'severity' => 'required',
                                                    'supportedTypes' => [
                                                        'Text',
                                                    ],
                                                ],
                                                'streetAddress' => [
                                                    'name' => 'streetAddress',
                                                    'severity' => 'required',
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
                                    ],
                                ],
                                'name' => [
                                    'name' => 'name',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        'target' => [
                            'name' => 'target',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'EntryPoint',
                            ],
                            'properties' => [
                                'actionPlatform' => [
                                    'name' => 'actionPlatform',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                    'value' => [
                                        'https://schema.org/DesktopWebPlatform',
                                        'https://schema.org/AndroidPlatform',
                                        'https://schema.org/IOSPlatform',
                                    ],
                                ],
                                'urlTemplate' => [
                                    'name' => 'urlTemplate',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'URL',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'author' => [
            'name' => 'author',
            'severity' => 'recommended',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#person-or-organization-author',
            'supportedTypes' => [
                'Person',
                'Organization',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'sameAs' => [
                    'name' => 'sameAs',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
            ],
        ],
        'bookEdition' => [
            'name' => 'bookEdition',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'datePublished' => [
            'name' => 'datePublished',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Date',
            ],
        ],
        'identifier' => [
            'name' => 'identifier',
            'severity' => 'recommended',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/book#propertyvalue-identifier',
            'supportedTypes' => [
                'PropertyValue',
            ],
            'properties' => [
                'propertyID' => [
                    'name' => 'propertyID',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                    'value' => [
                        'OCLC_NUMBER',
                        'LCCN',
                        'JP_E-CODE',
                    ],
                ],
                'value' => [
                    'name' => 'value',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'sameAs' => [
            'name' => 'sameAs',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
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
