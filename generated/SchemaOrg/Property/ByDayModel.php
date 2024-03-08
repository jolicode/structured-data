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

final class ByDayModel
{
    public const DESCRIPTION = 'Defines the day(s) of the week on which a recurring [[Event]] takes place. May be specified using either [[DayOfWeek]], or alternatively [[Text]] conforming to iCal\'s syntax for byDay recurrence rules.';
    public const LABEL = 'byDay';
    public const NAME = 'schema:byDay';
    public const VALUES = ['DayOfWeekModel' => 'SchemaOrg\Type\DayOfWeekModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Schedule' => 'SchemaOrg\Type\ScheduleModel'];
}
