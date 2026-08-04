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

final class EmployerAggregateRating
{
    public const SUPPORTED_TYPES = ['EmployerAggregateRating'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/employer-rating';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'itemReviewed' => [
            'name' => 'itemReviewed',
            'severity' => 'required',
            'supportedTypes' => [
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
