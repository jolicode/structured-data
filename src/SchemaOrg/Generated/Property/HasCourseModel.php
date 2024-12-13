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

final class HasCourseModel
{
    public const DESCRIPTION = 'A course or class that is one of the learning opportunities that constitute an educational / occupational program. No information is implied about whether the course is mandatory or optional; no guarantee is implied about whether the course will be available to everyone on the program.';
    public const LABEL = 'hasCourse';
    public const NAME = 'schema:hasCourse';
    public const VALUES = ['CourseModel' => 'Jolicode\SchemaOrg\Type\CourseModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
