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

final class FAQPage
{
    public const NAME = 'FAQPage';
    public const SUPPORTED_TYPES = ['FAQPage'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/faqpage';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['mainEntity' => ['name' => 'mainEntity', 'severity' => 'required', 'supportedTypes' => ['Question'], 'properties' => ['acceptedAnswer' => ['name' => 'acceptedAnswer', 'severity' => 'required', 'supportedTypes' => ['Answer'], 'properties' => ['text' => ['name' => 'text', 'severity' => 'required', 'supportedTypes' => ['Text']]]], 'name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']]]]];
}
