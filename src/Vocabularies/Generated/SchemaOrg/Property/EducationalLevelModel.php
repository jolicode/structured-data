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

final class EducationalLevelModel
{
    public const DESCRIPTION = 'The level in terms of progression through an educational or training context. Examples of educational levels include \'beginner\', \'intermediate\' or \'advanced\', and formal sets of level indicators.';
    public const LABEL = 'educationalLevel';
    public const NAME = 'schema:educationalLevel';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'EducationEvent' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationEventModel', 'EducationalOccupationalCredential' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'LearningResource' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LearningResourceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1779'];
    public const SUPERSEDED_BY = null;
}
