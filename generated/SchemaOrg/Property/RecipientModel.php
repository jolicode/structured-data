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

final class RecipientModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the receiving end of the action.';
    public const LABEL = 'recipient';
    public const NAME = 'schema:recipient';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\\Type\\AudienceModel', 'ContactPointModel' => 'SchemaOrg\\Type\\ContactPointModel', 'OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['AuthorizeAction' => 'SchemaOrg\\Type\\AuthorizeActionModel', 'CommunicateAction' => 'SchemaOrg\\Type\\CommunicateActionModel', 'DonateAction' => 'SchemaOrg\\Type\\DonateActionModel', 'GiveAction' => 'SchemaOrg\\Type\\GiveActionModel', 'Message' => 'SchemaOrg\\Type\\MessageModel', 'PayAction' => 'SchemaOrg\\Type\\PayActionModel', 'ReturnAction' => 'SchemaOrg\\Type\\ReturnActionModel', 'SendAction' => 'SchemaOrg\\Type\\SendActionModel', 'TipAction' => 'SchemaOrg\\Type\\TipActionModel'];
}
