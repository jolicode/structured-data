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

final class ScheduleTimezoneModel
{
    public const DESCRIPTION = 'Indicates the timezone for which the time(s) indicated in the [[Schedule]] are given. The value provided should be among those listed in the IANA Time Zone Database.';
    public const LABEL = 'scheduleTimezone';
    public const NAME = 'schema:scheduleTimezone';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Schedule' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
