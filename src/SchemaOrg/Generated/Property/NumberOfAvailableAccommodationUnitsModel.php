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

final class NumberOfAvailableAccommodationUnitsModel
{
    public const DESCRIPTION = 'Indicates the number of available accommodation units in an [[ApartmentComplex]], or the number of accommodation units for a specific [[FloorPlan]] (within its specific [[ApartmentComplex]]). See also [[numberOfAccommodationUnits]].';
    public const LABEL = 'numberOfAvailableAccommodationUnits';
    public const NAME = 'schema:numberOfAvailableAccommodationUnits';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ApartmentComplex' => 'Jolicode\SchemaOrg\Type\ApartmentComplexModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel'];
}
