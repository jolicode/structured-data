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

final class ArrivalTimeModel
{
    public const DESCRIPTION = 'The expected arrival time.';
    public const LABEL = 'arrivalTime';
    public const NAME = 'schema:arrivalTime';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'SchemaOrg\Type\TimeModel'];
    public const TYPES = ['Trip' => 'SchemaOrg\Type\TripModel'];
}
