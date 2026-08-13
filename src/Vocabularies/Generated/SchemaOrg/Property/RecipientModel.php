<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class RecipientModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the receiving end of the action.';
    public const LABEL = 'recipient';
    public const NAME = 'schema:recipient';
    public const VALUES = ['AudienceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['AuthorizeAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AuthorizeActionModel', 'CommunicateAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CommunicateActionModel', 'DonateAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DonateActionModel', 'GiveAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GiveActionModel', 'Message' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MessageModel', 'PayAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PayActionModel', 'ReturnAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReturnActionModel', 'SendAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SendActionModel', 'TipAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TipActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
