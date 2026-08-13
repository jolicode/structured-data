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

final class FuelTypeModel
{
    public const DESCRIPTION = 'The type of fuel suitable for the engine or engines of the vehicle. If the vehicle has only one engine, this property can be attached directly to the vehicle.';
    public const LABEL = 'fuelType';
    public const NAME = 'schema:fuelType';
    public const VALUES = ['QualitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['EngineSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EngineSpecificationModel', 'Vehicle' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
