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

final class ArrivalBoatTerminalModel
{
    public const DESCRIPTION = 'The terminal or port from which the boat arrives.';
    public const LABEL = 'arrivalBoatTerminal';
    public const NAME = 'schema:arrivalBoatTerminal';
    public const VALUES = ['BoatTerminalModel' => 'Jolicode\SchemaOrg\Type\BoatTerminalModel'];
    public const TYPES = ['BoatTrip' => 'Jolicode\SchemaOrg\Type\BoatTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
