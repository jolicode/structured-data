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

final class ToRecipientModel
{
    public const DESCRIPTION = 'A sub property of recipient. The recipient who was directly sent the message.';
    public const LABEL = 'toRecipient';
    public const NAME = 'schema:toRecipient';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'Jolicode\Vocabularies\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
