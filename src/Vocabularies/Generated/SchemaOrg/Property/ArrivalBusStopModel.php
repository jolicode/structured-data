<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ArrivalBusStopModel
{
    public const DESCRIPTION = 'The stop or station from which the bus arrives.';
    public const LABEL = 'arrivalBusStop';
    public const NAME = 'schema:arrivalBusStop';
    public const VALUES = ['BusStationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusStationModel', 'BusStopModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusStopModel'];
    public const TYPES = ['BusTrip' => 'Jolicode\Vocabularies\SchemaOrg\Type\BusTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
