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

final class BreadcrumbList
{
    public const SUPPORTED_TYPES = ['BreadcrumbList'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/breadcrumb#json-ld';
    public const SPECIAL_RULE_KEYS = ['google.breadcrumb.last_item_optional'];
    public const PROPERTIES = [
        'itemListElement' => [
            'name' => 'itemListElement',
            'severity' => 'required',
            'supportedTypes' => [
                'ListItem',
            ],
            'properties' => [
                'item' => [
                    'name' => 'item',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'URL',
                        'Thing',
                    ],
                    'properties' => [
                        '@id' => [
                            'name' => '@id',
                            'severity' => 'required',
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
                'position' => [
                    'name' => 'position',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
            ],
        ],
    ];
}
