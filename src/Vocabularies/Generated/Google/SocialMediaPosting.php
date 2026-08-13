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

final class SocialMediaPosting
{
    public const SUPPORTED_TYPES = ['DiscussionForumPosting', 'SocialMediaPosting'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/discussion-forum';
    public const SPECIAL_RULE_KEYS = ['google.discussion_forum.content_or_url'];
    public const PROPERTIES = [
        'author' => [
            'name' => 'author',
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
                'url' => [
                    'name' => 'url',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
            ],
        ],
        'datePublished' => [
            'name' => 'datePublished',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'atLeastOneOf' => [
            'name' => 'atLeastOneOf',
            'severity' => 'required',
            'value' => [
                'text' => true,
                'image' => true,
                'video' => true,
            ],
            'supportedTypes' => [
            ],
        ],
        'headline' => [
            'name' => 'headline',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'text' => [
            'name' => 'text',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'image' => [
            'name' => 'image',
            'severity' => 'optional',
            'supportedTypes' => [
                'ImageObject',
                'URL',
            ],
        ],
        'video' => [
            'name' => 'video',
            'severity' => 'optional',
            'supportedTypes' => [
                'VideoObject',
                'URL',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'comment' => [
            'name' => 'comment',
            'severity' => 'optional',
            'supportedTypes' => [
                'Comment',
            ],
            'properties' => [
                'author' => [
                    'name' => 'author',
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
                        'url' => [
                            'name' => 'url',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'URL',
                            ],
                        ],
                    ],
                ],
                'datePublished' => [
                    'name' => 'datePublished',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'DateTime',
                    ],
                ],
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'text' => true,
                        'image' => true,
                        'video' => true,
                    ],
                    'supportedTypes' => [
                    ],
                ],
                'text' => [
                    'name' => 'text',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'image' => [
                    'name' => 'image',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ImageObject',
                        'URL',
                    ],
                ],
                'video' => [
                    'name' => 'video',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'VideoObject',
                        'URL',
                    ],
                ],
            ],
        ],
    ];
}
