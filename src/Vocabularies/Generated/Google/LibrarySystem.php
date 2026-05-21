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

final class LibrarySystem
{
    public const NAME = 'LibrarySystem';
    public const SUPPORTED_TYPES = ['LibrarySystem'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/book#librarysystem';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
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
        'member' => [
            'name' => 'member',
            'severity' => 'required',
            'supportedTypes' => [
                '@Library',
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
            ],
        ],
    ];
}
