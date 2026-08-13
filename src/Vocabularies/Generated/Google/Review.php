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

final class Review
{
    public const SUPPORTED_TYPES = ['Review'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/review-snippet';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
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
        'itemReviewed' => [
            'name' => 'itemReviewed',
            'severity' => 'required',
            'supportedTypes' => [
                'Book',
                'Course',
                'CreativeWorkSeason',
                'CreativeWorkSeries',
                'Episode',
                'Event',
                'Game',
                'HowTo',
                'LocalBusiness',
                'MediaObject',
                'Movie',
                'MusicPlaylist',
                'MusicRecording',
                'Organization',
                'Product',
                'Recipe',
                'SoftwareApplication',
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
        'reviewRating' => [
            'name' => 'reviewRating',
            'severity' => 'required',
            'supportedTypes' => [
                'Rating',
                'AggregateRating',
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
        'datePublished' => [
            'name' => 'datePublished',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Date',
            ],
        ],
    ];
}
