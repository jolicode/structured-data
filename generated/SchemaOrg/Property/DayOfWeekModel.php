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

final class DayOfWeekModel
{
    public const DESCRIPTION = 'The day of the week for which these opening hours are valid.';
    public const LABEL = 'dayOfWeek';
    public const NAME = 'schema:dayOfWeek';
    public const VALUES = ['DayOfWeekModel' => 'SchemaOrg\Type\DayOfWeekModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'SchemaOrg\Type\EducationalOccupationalProgramModel', 'OpeningHoursSpecification' => 'SchemaOrg\Type\OpeningHoursSpecificationModel'];
}
