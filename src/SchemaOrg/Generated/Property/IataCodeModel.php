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

final class IataCodeModel
{
    public const DESCRIPTION = 'IATA identifier for an airline or airport.';
    public const LABEL = 'iataCode';
    public const NAME = 'schema:iataCode';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Airline' => 'Jolicode\SchemaOrg\Type\AirlineModel', 'Airport' => 'Jolicode\SchemaOrg\Type\AirportModel'];
}
