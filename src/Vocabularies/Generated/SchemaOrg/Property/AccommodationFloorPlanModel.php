<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class AccommodationFloorPlanModel
{
    public const DESCRIPTION = 'A floorplan of some [[Accommodation]].';
    public const LABEL = 'accommodationFloorPlan';
    public const NAME = 'schema:accommodationFloorPlan';
    public const VALUES = ['FloorPlanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FloorPlanModel'];
    public const TYPES = ['Accommodation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'Residence' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ResidenceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373'];
    public const SUPERSEDED_BY = null;
}
