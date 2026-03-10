<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class EstimatedFlightDurationModel
{
    public const DESCRIPTION = 'The estimated time the flight will take.';
    public const LABEL = 'estimatedFlightDuration';
    public const NAME = 'schema:estimatedFlightDuration';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'Jolicode\Vocabularies\SchemaOrg\Type\FlightModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
