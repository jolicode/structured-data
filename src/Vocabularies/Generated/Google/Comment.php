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

final class Comment
{
    public const NAME = 'Comment';
    public const SUPPORTED_TYPES = ['Comment'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/qapage#comment';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['text' => ['name' => 'text', 'severity' => 'required', 'supportedTypes' => ['Text']], 'author' => ['name' => 'author', 'severity' => 'recommended', 'supportedTypes' => ['Person', 'Organization'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'optional', 'supportedTypes' => ['Text']], 'url' => ['name' => 'url', 'severity' => 'recommended', 'supportedTypes' => ['URL']]]], 'comment' => ['name' => 'comment', 'severity' => 'optional', 'supportedTypes' => ['@Comment']], 'commentCount' => ['name' => 'commentCount', 'severity' => 'recommended', 'supportedTypes' => ['Integer']], 'dateModified' => ['name' => 'dateModified', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']], 'datePublished' => ['name' => 'datePublished', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']], 'digitalSourceType' => ['name' => 'digitalSourceType', 'severity' => 'recommended', 'supportedTypes' => ['Text'], 'value' => ['TrainedAlgorithmicMediaDigitalSource', 'AlgorithmicMediaDigitalSource']], 'image' => ['name' => 'image', 'severity' => 'recommended', 'supportedTypes' => ['ImageObject', 'URL']], 'video' => ['name' => 'video', 'severity' => 'recommended', 'supportedTypes' => ['VideoObject', 'URL']], 'interactionStatistic' => ['name' => 'interactionStatistic', 'severity' => 'optional', 'supportedTypes' => ['InteractionCounter'], 'properties' => ['interactionType' => ['name' => 'interactionType', 'severity' => 'required', 'supportedTypes' => ['URL']], 'userInteractionCount' => ['name' => 'userInteractionCount', 'severity' => 'required', 'supportedTypes' => ['Integer']]]]];
}
