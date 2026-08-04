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

final class BookWork extends Book
{
    public const SUPPORTED_TYPES = ['Book'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/book#book-work';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        '@id' => [
            'name' => '@id',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'author' => [
            'name' => 'author',
            'severity' => 'required',
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
        'workExample' => [
            'name' => 'workExample',
            'severity' => 'required',
            'supportedTypes' => [
                '@BookEdition',
            ],
        ],
        'sameAs' => [
            'name' => 'sameAs',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
    ];
}
