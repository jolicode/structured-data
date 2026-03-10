<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\EnumerationMember;

final class EventRescheduledModel
{
    public const DESCRIPTION = 'The event has been rescheduled. The event\'s previousStartDate should be set to the old date and the startDate should be set to the event\'s new date. (If the event has been rescheduled multiple times, the previousStartDate property may be repeated.)';
    public const LABEL = 'EventRescheduled';
    public const NAME = 'schema:EventRescheduled';
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
