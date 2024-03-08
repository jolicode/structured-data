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

final class DepartureBusStopModel
{
    public const DESCRIPTION = 'The stop or station from which the bus departs.';
    public const LABEL = 'departureBusStop';
    public const NAME = 'schema:departureBusStop';
    public const VALUES = ['BusStationModel' => 'SchemaOrg\Type\BusStationModel', 'BusStopModel' => 'SchemaOrg\Type\BusStopModel'];
    public const TYPES = ['BusTrip' => 'SchemaOrg\Type\BusTripModel'];
}
