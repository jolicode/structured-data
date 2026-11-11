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

final class VideoObject
{
    public const SUPPORTED_TYPES = ['VideoObject'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/video';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'thumbnailUrl' => [
            'name' => 'thumbnailUrl',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'uploadDate' => [
            'name' => 'uploadDate',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'recommended',
            'value' => [
                'creator' => true,
                'author' => true,
            ],
            'supportedTypes' => [
            ],
        ],
        'creator' => [
            'name' => 'creator',
            'severity' => 'optional',
            'supportedTypes' => [
                'Person',
                'Organization',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'name' => true,
                        'alternateName' => true,
                    ],
                    'supportedTypes' => [
                    ],
                ],
                'name' => [
                    'name' => 'name',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'alternateName' => [
                    'name' => 'alternateName',
                    'severity' => 'optional',
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
        'author' => [
            'name' => 'author',
            'severity' => 'optional',
            'supportedTypes' => [
                'Person',
                'Organization',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'name' => true,
                        'alternateName' => true,
                    ],
                    'supportedTypes' => [
                    ],
                ],
                'name' => [
                    'name' => 'name',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'alternateName' => [
                    'name' => 'alternateName',
                    'severity' => 'optional',
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
        'contentUrl' => [
            'name' => 'contentUrl',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'description' => [
            'name' => 'description',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'duration' => [
            'name' => 'duration',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Duration',
            ],
        ],
        'embedUrl' => [
            'name' => 'embedUrl',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'expires' => [
            'name' => 'expires',
            'severity' => 'recommended',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'regionsAllowed' => [
            'name' => 'regionsAllowed',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'ineligibleRegion' => [
            'name' => 'ineligibleRegion',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
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
                    'severity' => 'required',
                    'supportedTypes' => [
                        'WatchAction',
                        'LikeAction',
                        'CommentAction',
                        'ShareAction',
                    ],
                ],
                'userInteractionCount' => [
                    'name' => 'userInteractionCount',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Integer',
                        'Number',
                    ],
                ],
            ],
        ],
        'hasPart' => [
            'name' => 'hasPart',
            'severity' => 'optional',
            'supportedTypes' => [
                'Clip',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'startOffset' => [
                    'name' => 'startOffset',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
                'url' => [
                    'name' => 'url',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
                'endOffset' => [
                    'name' => 'endOffset',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Number',
                    ],
                ],
            ],
        ],
        'publication' => [
            'name' => 'publication',
            'severity' => 'optional',
            'supportedTypes' => [
                'BroadcastEvent',
            ],
            'properties' => [
                'isLiveBroadcast' => [
                    'name' => 'isLiveBroadcast',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Boolean',
                    ],
                ],
                'startDate' => [
                    'name' => 'startDate',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'DateTime',
                    ],
                ],
                'endDate' => [
                    'name' => 'endDate',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'DateTime',
                    ],
                ],
            ],
        ],
        'potentialAction' => [
            'name' => 'potentialAction',
            'severity' => 'optional',
            'supportedTypes' => [
                'SeekToAction',
            ],
            'properties' => [
                'target' => [
                    'name' => 'target',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'URL',
                        'EntryPoint',
                    ],
                ],
                'startOffset-input' => [
                    'name' => 'startOffset-input',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
    ];
}
