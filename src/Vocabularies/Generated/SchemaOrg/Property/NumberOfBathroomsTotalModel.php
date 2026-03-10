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

final class NumberOfBathroomsTotalModel
{
    public const DESCRIPTION = 'The total integer number of bathrooms in some [[Accommodation]], following real estate conventions as [documented in RESO](https://ddwiki.reso.org/display/DDW17/BathroomsTotalInteger+Field): "The simple sum of the number of bathrooms. For example for a property with two Full Bathrooms and one Half Bathroom, the Bathrooms Total Integer will be 3.". See also [[numberOfRooms]].';
    public const LABEL = 'numberOfBathroomsTotal';
    public const NAME = 'schema:numberOfBathroomsTotal';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'FloorPlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
