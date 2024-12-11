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

final class AircraftModel
{
    public const DESCRIPTION = 'The kind of aircraft (e.g., "Boeing 747").';
    public const LABEL = 'aircraft';
    public const NAME = 'schema:aircraft';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'VehicleModel' => 'Jolicode\SchemaOrg\Type\VehicleModel'];
    public const TYPES = ['Flight' => 'Jolicode\SchemaOrg\Type\FlightModel'];
}
