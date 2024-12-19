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

final class BccRecipientModel
{
    public const DESCRIPTION = 'A sub property of recipient. The recipient blind copied on a message.';
    public const LABEL = 'bccRecipient';
    public const NAME = 'schema:bccRecipient';
    public const VALUES = ['ContactPointModel' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'Jolicode\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
