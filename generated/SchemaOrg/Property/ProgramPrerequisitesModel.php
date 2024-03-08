<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ProgramPrerequisitesModel
{
    public const DESCRIPTION = 'Prerequisites for enrolling in the program.';
    public const LABEL = 'programPrerequisites';
    public const NAME = 'schema:programPrerequisites';
    public const VALUES = ['AlignmentObjectModel' => 'SchemaOrg\\Type\\AlignmentObjectModel', 'CourseModel' => 'SchemaOrg\\Type\\CourseModel', 'EducationalOccupationalCredentialModel' => 'SchemaOrg\\Type\\EducationalOccupationalCredentialModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\\Type\\EducationalOccupationalProgramModel'];
}
