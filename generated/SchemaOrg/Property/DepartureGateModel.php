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

final class DepartureGateModel
{
    public const DESCRIPTION = 'Identifier of the flight\'s departure gate.';
    public const LABEL = 'departureGate';
    public const NAME = 'schema:departureGate';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\Type\FlightModel'];
}
