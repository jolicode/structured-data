<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ByMonthWeekModel
{
    public const DESCRIPTION = 'Defines the week(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-5. For clarity, byMonthWeek is best used in conjunction with byDay to indicate concepts like the first and third Mondays of a month.';
    public const LABEL = 'byMonthWeek';
    public const NAME = 'schema:byMonthWeek';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Schedule' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
