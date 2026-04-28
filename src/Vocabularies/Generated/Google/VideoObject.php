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

final class VideoObject
{
    public const NAME = 'VideoObject';
    public const SUPPORTED_TYPES = ['VideoObject'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/video';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'thumbnailUrl' => ['name' => 'thumbnailUrl', 'severity' => 'required', 'supportedTypes' => ['URL']], 'uploadDate' => ['name' => 'uploadDate', 'severity' => 'required', 'supportedTypes' => ['DateTime']], 'contentUrl' => ['name' => 'contentUrl', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'description' => ['name' => 'description', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'duration' => ['name' => 'duration', 'severity' => 'recommended', 'supportedTypes' => ['Duration']], 'embedUrl' => ['name' => 'embedUrl', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'expires' => ['name' => 'expires', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']], 'regionsAllowed' => ['name' => 'regionsAllowed', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'ineligibleRegion' => ['name' => 'ineligibleRegion', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'interactionStatistic' => ['name' => 'interactionStatistic', 'severity' => 'recommended', 'supportedTypes' => ['InteractionCounter'], 'properties' => ['interactionType' => ['name' => 'interactionType', 'severity' => 'required', 'supportedTypes' => ['WatchAction']], 'userInteractionCount' => ['name' => 'userInteractionCount', 'severity' => 'required', 'supportedTypes' => ['Integer', 'Number']]]]];
}
