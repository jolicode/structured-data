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

final class RecipientModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the receiving end of the action.';
    public const LABEL = 'recipient';
    public const NAME = 'schema:recipient';
    public const VALUES = ['AudienceModel' => 'Jolicode\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['AuthorizeAction' => 'Jolicode\SchemaOrg\Type\AuthorizeActionModel', 'CommunicateAction' => 'Jolicode\SchemaOrg\Type\CommunicateActionModel', 'DonateAction' => 'Jolicode\SchemaOrg\Type\DonateActionModel', 'GiveAction' => 'Jolicode\SchemaOrg\Type\GiveActionModel', 'Message' => 'Jolicode\SchemaOrg\Type\MessageModel', 'PayAction' => 'Jolicode\SchemaOrg\Type\PayActionModel', 'ReturnAction' => 'Jolicode\SchemaOrg\Type\ReturnActionModel', 'SendAction' => 'Jolicode\SchemaOrg\Type\SendActionModel', 'TipAction' => 'Jolicode\SchemaOrg\Type\TipActionModel'];
}
