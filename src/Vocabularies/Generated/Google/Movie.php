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

final class Movie
{
    public const SUPPORTED_TYPES = ['Movie'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/movie';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'image' => [
            'name' => 'image',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
                'ImageObject',
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'required',
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
            'properties' => [
                'ratingCount' => [
                    'name' => 'ratingCount',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'ratingValue' => [
                    'name' => 'ratingValue',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                        'Text',
                    ],
                ],
                'bestRating' => [
                    'name' => 'bestRating',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'worstRating' => [
                    'name' => 'worstRating',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
            ],
        ],
        'dateCreated' => [
            'name' => 'dateCreated',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Date',
                'DateTime',
            ],
        ],
        'director' => [
            'name' => 'director',
            'severity' => 'recommended',
            'supportedTypes' => [
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
            ],
        ],
        'review' => [
            'name' => 'review',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Review',
            ],
            'properties' => [
                'author' => [
                    'name' => 'author',
                    'severity' => 'required',
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
                    ],
                ],
                'datePublished' => [
                    'name' => 'datePublished',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Date',
                    ],
                ],
                'reviewRating' => [
                    'name' => 'reviewRating',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Rating',
                    ],
                    'properties' => [
                        'ratingValue' => [
                            'name' => 'ratingValue',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Number',
                                'Text',
                            ],
                        ],
                        'bestRating' => [
                            'name' => 'bestRating',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Number',
                            ],
                        ],
                        'worstRating' => [
                            'name' => 'worstRating',
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
