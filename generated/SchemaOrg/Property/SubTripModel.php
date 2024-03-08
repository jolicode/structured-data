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

final class SubTripModel
{
    public const DESCRIPTION = 'Identifies a [[Trip]] that is a subTrip of this Trip.  For example Day 1, Day 2, etc. of a multi-day trip.';
    public const LABEL = 'subTrip';
    public const NAME = 'schema:subTrip';
    public const VALUES = ['TripModel' => 'SchemaOrg\Type\TripModel'];
    public const TYPES = ['Trip' => 'SchemaOrg\Type\TripModel'];
}
