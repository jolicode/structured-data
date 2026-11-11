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

final class ProfilePage
{
    public const SUPPORTED_TYPES = ['ProfilePage'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/profile-page';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'mainEntity' => [
            'name' => 'mainEntity',
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
                'agentInteractionStatistic' => [
                    'name' => 'agentInteractionStatistic',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'InteractionCounter',
                    ],
                    'properties' => [
                        'interactionType' => [
                            'name' => 'interactionType',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'URL',
                            ],
                        ],
                        'userInteractionCount' => [
                            'name' => 'userInteractionCount',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Integer',
                            ],
                        ],
                    ],
                ],
                'alternateName' => [
                    'name' => 'alternateName',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'description' => [
                    'name' => 'description',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'identifier' => [
                    'name' => 'identifier',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'image' => [
                    'name' => 'image',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'URL',
                        'ImageObject',
                    ],
                ],
                'interactionStatistic' => [
                    'name' => 'interactionStatistic',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'InteractionCounter',
                    ],
                    'properties' => [
                        'interactionType' => [
                            'name' => 'interactionType',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'URL',
                            ],
                        ],
                        'userInteractionCount' => [
                            'name' => 'userInteractionCount',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Integer',
                            ],
                        ],
                    ],
                ],
                'sameAs' => [
                    'name' => 'sameAs',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
            ],
        ],
        'dateCreated' => [
            'name' => 'dateCreated',
            'severity' => 'optional',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'dateModified' => [
            'name' => 'dateModified',
            'severity' => 'optional',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
    ];
}
