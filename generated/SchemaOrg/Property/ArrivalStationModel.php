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

final class ArrivalStationModel
{
    public const DESCRIPTION = 'The station where the train trip ends.';
    public const LABEL = 'arrivalStation';
    public const NAME = 'schema:arrivalStation';
    public const VALUES = ['TrainStationModel' => 'SchemaOrg\\Type\\TrainStationModel'];
    public const TYPES = ['TrainTrip' => 'SchemaOrg\\Type\\TrainTripModel'];
}
