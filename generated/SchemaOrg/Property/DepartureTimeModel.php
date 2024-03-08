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

final class DepartureTimeModel
{
    public const DESCRIPTION = 'The expected departure time.';
    public const LABEL = 'departureTime';
    public const NAME = 'schema:departureTime';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'SchemaOrg\Type\TimeModel'];
    public const TYPES = ['Trip' => 'SchemaOrg\Type\TripModel'];
}
