<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class BoardingPolicyModel
{
    public const DESCRIPTION = 'The type of boarding policy used by the airline (e.g. zone-based or group-based).';
    public const LABEL = 'boardingPolicy';
    public const NAME = 'schema:boardingPolicy';
    public const VALUES = ['BoardingPolicyTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BoardingPolicyTypeModel'];
    public const TYPES = ['Airline' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AirlineModel', 'Flight' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FlightModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
