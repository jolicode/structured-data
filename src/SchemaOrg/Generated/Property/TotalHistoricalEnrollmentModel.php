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

final class TotalHistoricalEnrollmentModel
{
    public const DESCRIPTION = 'The total number of students that have enrolled in the history of the course.';
    public const LABEL = 'totalHistoricalEnrollment';
    public const NAME = 'schema:totalHistoricalEnrollment';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Course' => 'Jolicode\SchemaOrg\Type\CourseModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
