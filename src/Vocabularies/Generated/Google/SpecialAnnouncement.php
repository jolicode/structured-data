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

final class SpecialAnnouncement
{
    public const SUPPORTED_TYPES = ['SpecialAnnouncement'];
    public const DOCUMENTATION = 'https://schema.org/SpecialAnnouncement';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'text' => [
            'name' => 'text',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'datePosted' => [
            'name' => 'datePosted',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'expires' => [
            'name' => 'expires',
            'severity' => 'recommended',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'diseasePreventionInfo' => [
            'name' => 'diseasePreventionInfo',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'schoolClosuresInfo' => [
            'name' => 'schoolClosuresInfo',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'announcementLocation' => [
            'name' => 'announcementLocation',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Place',
                'CivicStructure',
                'LocalBusiness',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'url' => [
                    'name' => 'url',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
            ],
        ],
    ];
}
