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

final class EmissionsCO2Model
{
    public const DESCRIPTION = 'The CO2 emissions in g/km. When used in combination with a QuantitativeValue, put "g/km" into the unitText property of that value, since there is no UN/CEFACT Common Code for "g/km".';
    public const LABEL = 'emissionsCO2';
    public const NAME = 'schema:emissionsCO2';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['Vehicle' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = ['https://auto.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
