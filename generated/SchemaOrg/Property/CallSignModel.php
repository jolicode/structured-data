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

final class CallSignModel
{
    public const DESCRIPTION = 'A [callsign](https://en.wikipedia.org/wiki/Call_sign), as used in broadcasting and radio communications to identify people, radio and TV stations, or vehicles.';
    public const LABEL = 'callSign';
    public const NAME = 'schema:callSign';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['BroadcastService' => 'SchemaOrg\\Type\\BroadcastServiceModel', 'Person' => 'SchemaOrg\\Type\\PersonModel', 'Vehicle' => 'SchemaOrg\\Type\\VehicleModel'];
}
