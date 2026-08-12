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

final class QualificationsModel
{
    public const DESCRIPTION = 'Specific qualifications required for this role or Occupation.';
    public const LABEL = 'qualifications';
    public const NAME = 'schema:qualifications';
    public const VALUES = ['CredentialModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CredentialModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1698', 'https://github.com/schemaorg/schemaorg/issues/1779'];
    public const SUPERSEDED_BY = null;
}
