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

final class ArrivalGateModel
{
    public const DESCRIPTION = 'Identifier of the flight\'s arrival gate.';
    public const LABEL = 'arrivalGate';
    public const NAME = 'schema:arrivalGate';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\\Type\\FlightModel'];
}
