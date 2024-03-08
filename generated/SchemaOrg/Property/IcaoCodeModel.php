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

final class IcaoCodeModel
{
    public const DESCRIPTION = 'ICAO identifier for an airport.';
    public const LABEL = 'icaoCode';
    public const NAME = 'schema:icaoCode';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Airport' => 'SchemaOrg\\Type\\AirportModel'];
}
