<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class DepartureStationModel
{
    public const DESCRIPTION = 'The station from which the train departs.';
    public const LABEL = 'departureStation';
    public const NAME = 'schema:departureStation';
    public const VALUES = ['TrainStationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TrainStationModel'];
    public const TYPES = ['TrainTrip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TrainTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
