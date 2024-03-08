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

final class EstimatedFlightDurationModel
{
    public const DESCRIPTION = 'The estimated time the flight will take.';
    public const LABEL = 'estimatedFlightDuration';
    public const NAME = 'schema:estimatedFlightDuration';
    public const VALUES = ['DurationModel' => 'SchemaOrg\Type\DurationModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\Type\FlightModel'];
}
