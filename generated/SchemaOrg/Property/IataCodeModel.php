<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IataCodeModel
{
    public const DESCRIPTION = 'IATA identifier for an airline or airport.';
    public const LABEL = 'iataCode';
    public const NAME = 'schema:iataCode';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Airline' => 'SchemaOrg\\Type\\AirlineModel', 'Airport' => 'SchemaOrg\\Type\\AirportModel'];
}
