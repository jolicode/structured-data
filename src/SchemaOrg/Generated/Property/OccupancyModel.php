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

final class OccupancyModel
{
    public const DESCRIPTION = 'The allowed total occupancy for the accommodation in persons (including infants etc). For individual accommodations, this is not necessarily the legal maximum but defines the permitted usage as per the contractual agreement (e.g. a double room used by a single person).
Typical unit code(s): C62 for person.';
    public const LABEL = 'occupancy';
    public const NAME = 'schema:occupancy';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'Apartment' => 'Jolicode\SchemaOrg\Type\ApartmentModel', 'HotelRoom' => 'Jolicode\SchemaOrg\Type\HotelRoomModel', 'SingleFamilyResidence' => 'Jolicode\SchemaOrg\Type\SingleFamilyResidenceModel', 'Suite' => 'Jolicode\SchemaOrg\Type\SuiteModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
