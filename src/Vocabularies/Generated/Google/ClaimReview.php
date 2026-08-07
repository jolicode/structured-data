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

final class ClaimReview
{
    public const SUPPORTED_TYPES = ['ClaimReview'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/factcheck';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'claimReviewed' => [
            'name' => 'claimReviewed',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'reviewRating' => [
            'name' => 'reviewRating',
            'severity' => 'required',
            'supportedTypes' => [
                'Rating',
            ],
            'properties' => [
                'alternateName' => [
                    'name' => 'alternateName',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'ratingValue' => [
                    'name' => 'ratingValue',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
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
        'url' => [
            'name' => 'url',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'author' => [
            'name' => 'author',
            'severity' => 'recommended',
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
        'itemReviewed' => [
            'name' => 'itemReviewed',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Claim',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'recommended',
                    'value' => [
                        'appearance' => true,
                        'firstAppearance' => true,
                    ],
                    'supportedTypes' => [
                    ],
                ],
                'appearance' => [
                    'name' => 'appearance',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'CreativeWork',
                        'URL',
                    ],
                ],
                'author' => [
                    'name' => 'author',
                    'severity' => 'optional',
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
                'datePublished' => [
                    'name' => 'datePublished',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Date',
                        'DateTime',
                    ],
                ],
                'firstAppearance' => [
                    'name' => 'firstAppearance',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'CreativeWork',
                        'URL',
                    ],
                ],
            ],
        ],
    ];
}
