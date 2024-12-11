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

final class DepartureBoatTerminalModel
{
    public const DESCRIPTION = 'The terminal or port from which the boat departs.';
    public const LABEL = 'departureBoatTerminal';
    public const NAME = 'schema:departureBoatTerminal';
    public const VALUES = ['BoatTerminalModel' => 'Jolicode\SchemaOrg\Type\BoatTerminalModel'];
    public const TYPES = ['BoatTrip' => 'Jolicode\SchemaOrg\Type\BoatTripModel'];
}
