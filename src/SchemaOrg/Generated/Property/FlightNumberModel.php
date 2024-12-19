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

final class FlightNumberModel
{
    public const DESCRIPTION = 'The unique identifier for a flight including the airline IATA code. For example, if describing United flight 110, where the IATA code for United is \'UA\', the flightNumber is \'UA110\'.';
    public const LABEL = 'flightNumber';
    public const NAME = 'schema:flightNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'Jolicode\SchemaOrg\Type\FlightModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
