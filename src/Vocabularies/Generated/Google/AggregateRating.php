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

final class AggregateRating
{
    public const NAME = 'AggregateRating';
    public const SUPPORTED_TYPES = ['AggregateRating'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/review-snippet';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
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
        'ratingValue' => [
            'name' => 'ratingValue',
            'severity' => 'required',
            'supportedTypes' => [
                'Number',
                'Text',
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'ratingCount' => true,
                'reviewCount' => true,
            ],
            'supportedTypes' => [
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
    ];
}
