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

final class FlightDistanceModel
{
    public const DESCRIPTION = 'The distance of the flight.';
    public const LABEL = 'flightDistance';
    public const NAME = 'schema:flightDistance';
    public const VALUES = ['DistanceModel' => 'Jolicode\SchemaOrg\Type\DistanceModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'Jolicode\SchemaOrg\Type\FlightModel'];
}
