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

final class ProgramPrerequisitesModel
{
    public const DESCRIPTION = 'Prerequisites for enrolling in the program.';
    public const LABEL = 'programPrerequisites';
    public const NAME = 'schema:programPrerequisites';
    public const VALUES = ['AlignmentObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AlignmentObjectModel', 'CourseModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CourseModel', 'EducationalOccupationalCredentialModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2289'];
    public const SUPERSEDED_BY = null;
}
