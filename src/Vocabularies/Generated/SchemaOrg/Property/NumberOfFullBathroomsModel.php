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

final class NumberOfFullBathroomsModel
{
    public const DESCRIPTION = 'Number of full bathrooms - The total number of full and ¾ bathrooms in an [[Accommodation]]. This corresponds to the [BathroomsFull field in RESO](https://ddwiki.reso.org/display/DDW17/BathroomsFull+Field).';
    public const LABEL = 'numberOfFullBathrooms';
    public const NAME = 'schema:numberOfFullBathrooms';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['Accommodation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'FloorPlan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FloorPlanModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373'];
    public const SUPERSEDED_BY = null;
}
