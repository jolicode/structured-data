<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class InLanguageModel
{
    public const DESCRIPTION = 'The language of the content or performance or used in an action. Please use one of the language codes from the [IETF BCP 47 standard](http://tools.ietf.org/html/bcp47). See also [[availableLanguage]].';
    public const LABEL = 'inLanguage';
    public const NAME = 'schema:inLanguage';
    public const VALUES = ['LanguageModel' => 'Jolicode\SchemaOrg\Type\LanguageModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastService' => 'Jolicode\SchemaOrg\Type\BroadcastServiceModel', 'CommunicateAction' => 'Jolicode\SchemaOrg\Type\CommunicateActionModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'LinkRole' => 'Jolicode\SchemaOrg\Type\LinkRoleModel', 'PronounceableText' => 'Jolicode\SchemaOrg\Type\PronounceableTextModel', 'WriteAction' => 'Jolicode\SchemaOrg\Type\WriteActionModel'];
}
