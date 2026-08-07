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

final class SpeakableSpecification
{
    public const SUPPORTED_TYPES = ['SpeakableSpecification'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/speakable';
    public const SPECIAL_RULE_KEYS = ['google.speakable.cssselector_or_xpath'];
    public const PROPERTIES = [
        'cssSelector' => [
            'name' => 'cssSelector',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'xPath' => [
            'name' => 'xPath',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
    ];
}
