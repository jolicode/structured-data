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

final class SenderModel
{
    public const DESCRIPTION = 'A sub property of participant. The participant who is at the sending end of the action.';
    public const LABEL = 'sender';
    public const NAME = 'schema:sender';
    public const VALUES = ['AudienceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudienceModel', 'OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Message' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MessageModel', 'ReceiveAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReceiveActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
