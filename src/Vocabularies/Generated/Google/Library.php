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

final class Library
{
    public const SUPPORTED_TYPES = ['Library'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/book#library-member';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
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
    ];
}
