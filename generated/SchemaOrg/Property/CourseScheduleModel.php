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

final class CourseScheduleModel
{
    public const DESCRIPTION = 'Represents the length and pace of a course, expressed as a [[Schedule]].';
    public const LABEL = 'courseSchedule';
    public const NAME = 'schema:courseSchedule';
    public const VALUES = ['ScheduleModel' => 'SchemaOrg\\Type\\ScheduleModel'];
    public const TYPES = ['CourseInstance' => 'SchemaOrg\\Type\\CourseInstanceModel'];
}
