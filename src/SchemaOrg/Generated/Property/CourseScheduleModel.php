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

final class CourseScheduleModel
{
    public const DESCRIPTION = 'Represents the length and pace of a course, expressed as a [[Schedule]].';
    public const LABEL = 'courseSchedule';
    public const NAME = 'schema:courseSchedule';
    public const VALUES = ['ScheduleModel' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
    public const TYPES = ['CourseInstance' => 'Jolicode\SchemaOrg\Type\CourseInstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
