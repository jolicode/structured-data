<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class RecipientModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the receiving end of the action.';
    public const LABEL = 'recipient';
    public const NAME = 'schema:recipient';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['AuthorizeAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\AuthorizeActionModel', 'CommunicateAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\CommunicateActionModel', 'DonateAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\DonateActionModel', 'GiveAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\GiveActionModel', 'Message' => 'Jolicode\Vocabularies\SchemaOrg\Type\MessageModel', 'PayAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\PayActionModel', 'ReturnAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReturnActionModel', 'SendAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\SendActionModel', 'TipAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\TipActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
