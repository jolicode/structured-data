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

final class MaximumPhysicalAttendeeCapacityModel
{
    public const DESCRIPTION = 'The maximum physical attendee capacity of an [[Event]] whose [[eventAttendanceMode]] is [[OfflineEventAttendanceMode]] (or the offline aspects, in the case of a [[MixedEventAttendanceMode]]). ';
    public const LABEL = 'maximumPhysicalAttendeeCapacity';
    public const NAME = 'schema:maximumPhysicalAttendeeCapacity';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel'];
}
