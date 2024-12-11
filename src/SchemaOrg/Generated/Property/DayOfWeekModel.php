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

final class DayOfWeekModel
{
    public const DESCRIPTION = 'The day of the week for which these opening hours are valid.';
    public const LABEL = 'dayOfWeek';
    public const NAME = 'schema:dayOfWeek';
    public const VALUES = ['DayOfWeekModel' => 'Jolicode\SchemaOrg\Type\DayOfWeekModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalProgramModel', 'OpeningHoursSpecification' => 'Jolicode\SchemaOrg\Type\OpeningHoursSpecificationModel'];
}
