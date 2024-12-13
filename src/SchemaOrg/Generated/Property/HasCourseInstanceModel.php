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

final class HasCourseInstanceModel
{
    public const DESCRIPTION = 'An offering of the course at a specific time and place or through specific media or mode of study or to a specific section of students.';
    public const LABEL = 'hasCourseInstance';
    public const NAME = 'schema:hasCourseInstance';
    public const VALUES = ['CourseInstanceModel' => 'Jolicode\SchemaOrg\Type\CourseInstanceModel'];
    public const TYPES = ['Course' => 'Jolicode\SchemaOrg\Type\CourseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
