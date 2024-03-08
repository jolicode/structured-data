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

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class ScheduleModel
{
    public const DESCRIPTION = 'A schedule defines a repeating time period used to describe a regularly occurring [[Event]]. At a minimum a schedule will specify [[repeatFrequency]] which describes the interval between occurrences of the event. Additional information can be provided to specify the schedule more precisely.
      This includes identifying the day(s) of the week or month when the recurring event will take place, in addition to its start and end time. Schedules may also
      have start and end dates to indicate when they are active, e.g. to define a limited calendar of events.';
    public const LABEL = 'Schedule';
    public const NAME = 'schema:Schedule';
    public const PARENTS = ['IntangibleModel' => 'SchemaOrg\\Type\\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\ByDayModel $byDay = null,
        public ?Property\ByMonthModel $byMonth = null,
        public ?Property\ByMonthDayModel $byMonthDay = null,
        public ?Property\ByMonthWeekModel $byMonthWeek = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DurationModel $duration = null,
        public ?Property\EndDateModel $endDate = null,
        public ?Property\EndTimeModel $endTime = null,
        public ?Property\ExceptDateModel $exceptDate = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\RepeatCountModel $repeatCount = null,
        public ?Property\RepeatFrequencyModel $repeatFrequency = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ScheduleTimezoneModel $scheduleTimezone = null,
        public ?Property\StartDateModel $startDate = null,
        public ?Property\StartTimeModel $startTime = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
