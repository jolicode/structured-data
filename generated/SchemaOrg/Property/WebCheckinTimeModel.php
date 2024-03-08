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

final class WebCheckinTimeModel
{
    public const DESCRIPTION = 'The time when a passenger can check into the flight online.';
    public const LABEL = 'webCheckinTime';
    public const NAME = 'schema:webCheckinTime';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\Type\FlightModel'];
}
