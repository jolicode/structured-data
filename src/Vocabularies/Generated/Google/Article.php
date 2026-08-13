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

final class Article
{
    public const SUPPORTED_TYPES = ['Article', 'NewsArticle', 'BlogPosting'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/article#article-objects';
    public const SPECIAL_RULE_KEYS = ['google.article.author_url_or_sameas'];
    public const PROPERTIES = [
        'author' => [
            'name' => 'author',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Person',
                'Organization',
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
        'dateModified' => [
            'name' => 'dateModified',
            'severity' => 'recommended',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'datePublished' => [
            'name' => 'datePublished',
            'severity' => 'recommended',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
        'headline' => [
            'name' => 'headline',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'image' => [
            'name' => 'image',
            'severity' => 'recommended',
            'supportedTypes' => [
                'ImageObject',
                'URL',
            ],
            'properties' => [
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
