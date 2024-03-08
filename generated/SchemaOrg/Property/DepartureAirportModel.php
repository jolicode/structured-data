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

final class DepartureAirportModel
{
    public const DESCRIPTION = 'The airport where the flight originates.';
    public const LABEL = 'departureAirport';
    public const NAME = 'schema:departureAirport';
    public const VALUES = ['AirportModel' => 'SchemaOrg\Type\AirportModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\Type\FlightModel'];
}
