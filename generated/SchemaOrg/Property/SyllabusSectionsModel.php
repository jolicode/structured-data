<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class SyllabusSectionsModel
{
    public const DESCRIPTION = 'Indicates (typically several) Syllabus entities that lay out what each section of the overall course will cover.';
    public const LABEL = 'syllabusSections';
    public const NAME = 'schema:syllabusSections';
    public const VALUES = ['SyllabusModel' => 'SchemaOrg\Type\SyllabusModel'];
    public const TYPES = ['Course' => 'SchemaOrg\Type\CourseModel'];
}
