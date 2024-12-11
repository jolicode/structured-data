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

final class ProgramPrerequisitesModel
{
    public const DESCRIPTION = 'Prerequisites for enrolling in the program.';
    public const LABEL = 'programPrerequisites';
    public const NAME = 'schema:programPrerequisites';
    public const VALUES = ['AlignmentObjectModel' => 'Jolicode\SchemaOrg\Type\AlignmentObjectModel', 'CourseModel' => 'Jolicode\SchemaOrg\Type\CourseModel', 'EducationalOccupationalCredentialModel' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
}
