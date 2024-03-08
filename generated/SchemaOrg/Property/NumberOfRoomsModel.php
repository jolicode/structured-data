<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class NumberOfRoomsModel
{
    public const DESCRIPTION = 'The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business.
Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.';
    public const LABEL = 'numberOfRooms';
    public const NAME = 'schema:numberOfRooms';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\Type\AccommodationModel', 'Apartment' => 'SchemaOrg\Type\ApartmentModel', 'FloorPlan' => 'SchemaOrg\Type\FloorPlanModel', 'House' => 'SchemaOrg\Type\HouseModel', 'LodgingBusiness' => 'SchemaOrg\Type\LodgingBusinessModel', 'SingleFamilyResidence' => 'SchemaOrg\Type\SingleFamilyResidenceModel', 'Suite' => 'SchemaOrg\Type\SuiteModel'];
}
