<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SenderModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the sending end of the action.';
    public const LABEL = 'sender';
    public const NAME = 'schema:sender';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\Type\AudienceModel', 'OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'SchemaOrg\Type\MessageModel', 'ReceiveAction' => 'SchemaOrg\Type\ReceiveActionModel'];
}
