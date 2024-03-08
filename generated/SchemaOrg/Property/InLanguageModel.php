<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InLanguageModel
{
    public const DESCRIPTION = 'The language of the content or performance or used in an action. Please use one of the language codes from the [IETF BCP 47 standard](http://tools.ietf.org/html/bcp47). See also [[availableLanguage]].';
    public const LABEL = 'inLanguage';
    public const NAME = 'schema:inLanguage';
    public const VALUES = ['LanguageModel' => 'SchemaOrg\\Type\\LanguageModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\\Type\\BroadcastServiceModel', 'CommunicateAction' => 'SchemaOrg\\Type\\CommunicateActionModel', 'CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Event' => 'SchemaOrg\\Type\\EventModel', 'LinkRole' => 'SchemaOrg\\Type\\LinkRoleModel', 'PronounceableText' => 'SchemaOrg\\Type\\PronounceableTextModel', 'WriteAction' => 'SchemaOrg\\Type\\WriteActionModel'];
}
