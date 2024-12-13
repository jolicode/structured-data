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

final class CourseWorkloadModel
{
    public const DESCRIPTION = 'The amount of work expected of students taking the course, often provided as a figure per week or per month, and may be broken down by type. For example, "2 hours of lectures, 1 hour of lab work and 3 hours of independent study per week".';
    public const LABEL = 'courseWorkload';
    public const NAME = 'schema:courseWorkload';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CourseInstance' => 'Jolicode\SchemaOrg\Type\CourseInstanceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
