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

final class NumberOfRoomsModel
{
    public const DESCRIPTION = 'The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business.
Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.';
    public const LABEL = 'numberOfRooms';
    public const NAME = 'schema:numberOfRooms';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'Apartment' => 'Jolicode\Vocabularies\SchemaOrg\Type\ApartmentModel', 'FloorPlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel', 'House' => 'Jolicode\Vocabularies\SchemaOrg\Type\HouseModel', 'LodgingBusiness' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingBusinessModel', 'SingleFamilyResidence' => 'Jolicode\Vocabularies\SchemaOrg\Type\SingleFamilyResidenceModel', 'Suite' => 'Jolicode\Vocabularies\SchemaOrg\Type\SuiteModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
