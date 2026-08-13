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

final class CourseScheduleModel
{
    public const DESCRIPTION = 'Represents the length and pace of a course, expressed as a [[Schedule]].';
    public const LABEL = 'courseSchedule';
    public const NAME = 'schema:courseSchedule';
    public const VALUES = ['ScheduleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ScheduleModel'];
    public const TYPES = ['CourseInstance' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CourseInstanceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3281'];
    public const SUPERSEDED_BY = null;
}
