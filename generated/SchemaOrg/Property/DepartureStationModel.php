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

final class DepartureStationModel
{
    public const DESCRIPTION = 'The station from which the train departs.';
    public const LABEL = 'departureStation';
    public const NAME = 'schema:departureStation';
    public const VALUES = ['TrainStationModel' => 'SchemaOrg\\Type\\TrainStationModel'];
    public const TYPES = ['TrainTrip' => 'SchemaOrg\\Type\\TrainTripModel'];
}
