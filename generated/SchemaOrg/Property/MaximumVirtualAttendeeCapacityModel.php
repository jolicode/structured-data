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

final class MaximumVirtualAttendeeCapacityModel
{
    public const DESCRIPTION = 'The maximum virtual attendee capacity of an [[Event]] whose [[eventAttendanceMode]] is [[OnlineEventAttendanceMode]] (or the online aspects, in the case of a [[MixedEventAttendanceMode]]). ';
    public const LABEL = 'maximumVirtualAttendeeCapacity';
    public const NAME = 'schema:maximumVirtualAttendeeCapacity';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Event' => 'SchemaOrg\Type\EventModel'];
}
