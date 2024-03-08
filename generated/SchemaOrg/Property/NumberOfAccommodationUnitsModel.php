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

final class NumberOfAccommodationUnitsModel
{
    public const DESCRIPTION = 'Indicates the total (available plus unavailable) number of accommodation units in an [[ApartmentComplex]], or the number of accommodation units for a specific [[FloorPlan]] (within its specific [[ApartmentComplex]]). See also [[numberOfAvailableAccommodationUnits]].';
    public const LABEL = 'numberOfAccommodationUnits';
    public const NAME = 'schema:numberOfAccommodationUnits';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ApartmentComplex' => 'SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'SchemaOrg\Type\FloorPlanModel'];
}
