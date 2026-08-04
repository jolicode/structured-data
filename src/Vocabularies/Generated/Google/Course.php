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

final class Course
{
    public const SUPPORTED_TYPES = ['Course'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/course';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'description' => [
            'name' => 'description',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'provider' => [
            'name' => 'provider',
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
    ];
}
