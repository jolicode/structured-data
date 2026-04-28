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

final class ProfilePage
{
    public const NAME = 'ProfilePage';
    public const SUPPORTED_TYPES = ['ProfilePage'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/profile-page';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['mainEntity' => ['name' => 'mainEntity', 'severity' => 'required', 'supportedTypes' => ['Person', 'Organization'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'agentInteractionStatistic' => ['name' => 'agentInteractionStatistic', 'severity' => 'recommended', 'supportedTypes' => ['InteractionCounter'], 'properties' => ['interactionType' => ['name' => 'interactionType', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'userInteractionCount' => ['name' => 'userInteractionCount', 'severity' => 'recommended', 'supportedTypes' => ['Integer']]]], 'alternateName' => ['name' => 'alternateName', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'description' => ['name' => 'description', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'identifier' => ['name' => 'identifier', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'image' => ['name' => 'image', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'ImageObject']], 'interactionStatistic' => ['name' => 'interactionStatistic', 'severity' => 'recommended', 'supportedTypes' => ['InteractionCounter'], 'properties' => ['interactionType' => ['name' => 'interactionType', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'userInteractionCount' => ['name' => 'userInteractionCount', 'severity' => 'recommended', 'supportedTypes' => ['Integer']]]], 'sameAs' => ['name' => 'sameAs', 'severity' => 'recommended', 'supportedTypes' => ['URL']]]], 'dateCreated' => ['name' => 'dateCreated', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']], 'dateModified' => ['name' => 'dateModified', 'severity' => 'recommended', 'supportedTypes' => ['DateTime']]];
}
