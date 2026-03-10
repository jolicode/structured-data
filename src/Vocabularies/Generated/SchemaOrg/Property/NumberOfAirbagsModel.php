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

final class NumberOfAirbagsModel
{
    public const DESCRIPTION = 'The number or type of airbags in the vehicle.';
    public const LABEL = 'numberOfAirbags';
    public const NAME = 'schema:numberOfAirbags';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\Vocabularies\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
