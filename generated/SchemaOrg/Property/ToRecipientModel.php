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

final class ToRecipientModel
{
    public const DESCRIPTION = 'A sub property of recipient. The recipient who was directly sent the message.';
    public const LABEL = 'toRecipient';
    public const NAME = 'schema:toRecipient';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\\Type\\AudienceModel', 'ContactPointModel' => 'SchemaOrg\\Type\\ContactPointModel', 'OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Message' => 'SchemaOrg\\Type\\MessageModel'];
}
