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

final class EducationalCredentialAwardedModel
{
    public const DESCRIPTION = 'A description of the qualification, award, certificate, diploma or other educational credential awarded as a consequence of successful completion of this course or program.';
    public const LABEL = 'educationalCredentialAwarded';
    public const NAME = 'schema:educationalCredentialAwarded';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Course' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CourseModel', 'EducationalOccupationalProgram' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2289'];
    public const SUPERSEDED_BY = null;
}
