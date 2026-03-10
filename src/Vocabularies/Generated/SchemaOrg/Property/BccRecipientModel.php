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

final class BccRecipientModel
{
    public const DESCRIPTION = 'A sub property of recipient. The recipient blind copied on a message.';
    public const LABEL = 'bccRecipient';
    public const NAME = 'schema:bccRecipient';
    public const VALUES = ['ContactPointModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'Jolicode\Vocabularies\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
