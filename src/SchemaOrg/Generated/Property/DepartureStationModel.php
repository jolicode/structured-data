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

final class DepartureStationModel
{
    public const DESCRIPTION = 'The station from which the train departs.';
    public const LABEL = 'departureStation';
    public const NAME = 'schema:departureStation';
    public const VALUES = ['TrainStationModel' => 'Jolicode\SchemaOrg\Type\TrainStationModel'];
    public const TYPES = ['TrainTrip' => 'Jolicode\SchemaOrg\Type\TrainTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
