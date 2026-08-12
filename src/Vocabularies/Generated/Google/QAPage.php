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

final class QAPage
{
    public const SUPPORTED_TYPES = ['QAPage'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/qapage';
    public const SPECIAL_RULE_KEYS = ['google.qapage.answer_comment_count_consistency'];
    public const PROPERTIES = [
        'mainEntity' => [
            'name' => 'mainEntity',
            'severity' => 'required',
            'supportedTypes' => [
                '@Question',
            ],
        ],
    ];
}
