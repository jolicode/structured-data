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

final class NumberOfBedroomsModel
{
    public const DESCRIPTION = 'The total integer number of bedrooms in a some [[Accommodation]], [[ApartmentComplex]] or [[FloorPlan]].';
    public const LABEL = 'numberOfBedrooms';
    public const NAME = 'schema:numberOfBedrooms';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\\Type\\AccommodationModel', 'ApartmentComplex' => 'SchemaOrg\\Type\\ApartmentComplexModel', 'FloorPlan' => 'SchemaOrg\\Type\\FloorPlanModel'];
}
