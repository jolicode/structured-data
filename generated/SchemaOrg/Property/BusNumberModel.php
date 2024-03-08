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

final class BusNumberModel
{
    public const DESCRIPTION = 'The unique identifier for the bus.';
    public const LABEL = 'busNumber';
    public const NAME = 'schema:busNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['BusTrip' => 'SchemaOrg\\Type\\BusTripModel'];
}
