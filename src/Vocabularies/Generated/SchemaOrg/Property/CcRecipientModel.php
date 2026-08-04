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

final class CcRecipientModel
{
    public const DESCRIPTION = 'A sub property of recipient. The recipient copied on a message.';
    public const LABEL = 'ccRecipient';
    public const NAME = 'schema:ccRecipient';
    public const VALUES = ['ContactPointModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MessageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
