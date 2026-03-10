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

final class AccommodationFloorPlanModel
{
    public const DESCRIPTION = 'A floorplan of some [[Accommodation]].';
    public const LABEL = 'accommodationFloorPlan';
    public const NAME = 'schema:accommodationFloorPlan';
    public const VALUES = ['FloorPlanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'Residence' => 'Jolicode\Vocabularies\SchemaOrg\Type\ResidenceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
