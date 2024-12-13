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

final class ArrivalStationModel
{
    public const DESCRIPTION = 'The station where the train trip ends.';
    public const LABEL = 'arrivalStation';
    public const NAME = 'schema:arrivalStation';
    public const VALUES = ['TrainStationModel' => 'Jolicode\SchemaOrg\Type\TrainStationModel'];
    public const TYPES = ['TrainTrip' => 'Jolicode\SchemaOrg\Type\TrainTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
