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

final class ValidInModel
{
    public const DESCRIPTION = 'The geographic area where the item is valid. Applies for example to a [[Permit]], a [[Certification]], or an [[EducationalOccupationalCredential]].';
    public const LABEL = 'validIn';
    public const NAME = 'schema:validIn';
    public const VALUES = ['AdministrativeAreaModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['Certification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CertificationModel', 'Credential' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CredentialModel', 'Permit' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1779'];
    public const SUPERSEDED_BY = null;
}
