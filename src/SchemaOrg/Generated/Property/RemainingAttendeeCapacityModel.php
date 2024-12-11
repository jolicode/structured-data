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

final class RemainingAttendeeCapacityModel
{
    public const DESCRIPTION = 'The number of attendee places for an event that remain unallocated.';
    public const LABEL = 'remainingAttendeeCapacity';
    public const NAME = 'schema:remainingAttendeeCapacity';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
}
