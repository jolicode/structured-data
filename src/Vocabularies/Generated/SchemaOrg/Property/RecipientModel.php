<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class RecipientModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the receiving end of the action.';
    public const LABEL = 'recipient';
    public const NAME = 'schema:recipient';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['AuthorizeAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AuthorizeActionModel', 'CommunicateAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CommunicateActionModel', 'DonateAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DonateActionModel', 'GiveAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GiveActionModel', 'Message' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MessageModel', 'PayAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PayActionModel', 'ReturnAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReturnActionModel', 'SendAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SendActionModel', 'TipAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TipActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
