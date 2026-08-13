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

final class ImageObject
{
    public const SUPPORTED_TYPES = ['ImageObject'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/image-license-metadata';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'contentUrl' => [
            'name' => 'contentUrl',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'creator' => true,
                'creditText' => true,
                'copyrightNotice' => true,
                'license' => true,
            ],
        ],
        'creator' => [
            'name' => 'creator',
            'severity' => 'optional',
            'supportedTypes' => [
                'Organization',
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
        'creditText' => [
            'name' => 'creditText',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'copyrightNotice' => [
            'name' => 'copyrightNotice',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'license' => [
            'name' => 'license',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'acquireLicensePage' => [
            'name' => 'acquireLicensePage',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
    ];
}
