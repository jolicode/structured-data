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

final class NumberOfBedroomsModel
{
    public const DESCRIPTION = 'The total integer number of bedrooms in a some [[Accommodation]], [[ApartmentComplex]] or [[FloorPlan]].';
    public const LABEL = 'numberOfBedrooms';
    public const NAME = 'schema:numberOfBedrooms';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'ApartmentComplex' => 'Jolicode\SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel'];
}
