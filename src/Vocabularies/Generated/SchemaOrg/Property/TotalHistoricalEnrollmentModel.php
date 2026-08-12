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

final class TotalHistoricalEnrollmentModel
{
    public const DESCRIPTION = 'The total number of students that have enrolled in the history of the course.';
    public const LABEL = 'totalHistoricalEnrollment';
    public const NAME = 'schema:totalHistoricalEnrollment';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Course' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CourseModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3281'];
    public const SUPERSEDED_BY = null;
}
