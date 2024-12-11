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

final class MaximumAttendeeCapacityModel
{
    public const DESCRIPTION = 'The total number of individuals that may attend an event or venue.';
    public const LABEL = 'maximumAttendeeCapacity';
    public const NAME = 'schema:maximumAttendeeCapacity';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
}
