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

final class ImageObject
{
    public const NAME = 'ImageObject';
    public const SUPPORTED_TYPES = ['ImageObject'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/image-license-metadata';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['contentUrl' => ['name' => 'contentUrl', 'severity' => 'required', 'supportedTypes' => ['URL']], 'atLeastOneOf' => ['name' => 'atLeastOneOf', 'severity' => 'required', 'value' => ['creator' => [], 'creditText' => [], 'copyrightNotice' => [], 'license' => []]], 'creator' => ['name' => 'creator', 'severity' => 'optional', 'supportedTypes' => ['Organization', 'Person'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]], 'creditText' => ['name' => 'creditText', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'copyrightNotice' => ['name' => 'copyrightNotice', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'license' => ['name' => 'license', 'severity' => 'optional', 'supportedTypes' => ['URL']], 'acquireLicensePage' => ['name' => 'acquireLicensePage', 'severity' => 'recommended', 'supportedTypes' => ['URL']]];
}
