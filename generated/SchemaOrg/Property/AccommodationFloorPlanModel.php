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

final class AccommodationFloorPlanModel
{
    public const DESCRIPTION = 'A floorplan of some [[Accommodation]].';
    public const LABEL = 'accommodationFloorPlan';
    public const NAME = 'schema:accommodationFloorPlan';
    public const VALUES = ['FloorPlanModel' => 'SchemaOrg\Type\FloorPlanModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\Type\AccommodationModel', 'Residence' => 'SchemaOrg\Type\ResidenceModel'];
}
