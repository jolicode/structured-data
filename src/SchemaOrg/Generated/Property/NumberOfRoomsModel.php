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

final class NumberOfRoomsModel
{
    public const DESCRIPTION = 'The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business.
Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.';
    public const LABEL = 'numberOfRooms';
    public const NAME = 'schema:numberOfRooms';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'Apartment' => 'Jolicode\SchemaOrg\Type\ApartmentModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel', 'House' => 'Jolicode\SchemaOrg\Type\HouseModel', 'LodgingBusiness' => 'Jolicode\SchemaOrg\Type\LodgingBusinessModel', 'SingleFamilyResidence' => 'Jolicode\SchemaOrg\Type\SingleFamilyResidenceModel', 'Suite' => 'Jolicode\SchemaOrg\Type\SuiteModel'];
}
