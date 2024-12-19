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

final class EventScheduleModel
{
    public const DESCRIPTION = 'Associates an [[Event]] with a [[Schedule]]. There are circumstances where it is preferable to share a schedule for a series of
      repeating events rather than data on the individual events themselves. For example, a website or application might prefer to publish a schedule for a weekly
      gym class rather than provide data on every event. A schedule could be processed by applications to add forthcoming events to a calendar. An [[Event]] that
      is associated with a [[Schedule]] using this property should not have [[startDate]] or [[endDate]] properties. These are instead defined within the associated
      [[Schedule]], this avoids any ambiguity for clients using the data. The property might have repeated values to specify different schedules, e.g. for different months
      or seasons.';
    public const LABEL = 'eventSchedule';
    public const NAME = 'schema:eventSchedule';
    public const VALUES = ['ScheduleModel' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
