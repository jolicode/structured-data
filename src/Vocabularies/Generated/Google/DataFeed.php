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

final class DataFeed
{
    public const NAME = 'DataFeed';
    public const SUPPORTED_TYPES = ['DataFeed'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/book#datafeed-entity';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.book.offer_pricing_by_category'];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
        'dataFeedElement' => [
            'name' => 'dataFeedElement',
            'severity' => 'required',
            'supportedTypes' => [
                '@BookWork',
                '@LibrarySystem',
            ],
        ],
        'dateModified' => [
            'name' => 'dateModified',
            'severity' => 'required',
            'supportedTypes' => [
                'DateTime',
            ],
        ],
    ];
}
