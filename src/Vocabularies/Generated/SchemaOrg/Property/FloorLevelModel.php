<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class FloorLevelModel
{
    public const DESCRIPTION = 'The floor level for an [[Accommodation]] in a multi-storey building. Since counting
  systems [vary internationally](https://en.wikipedia.org/wiki/Storey#Consecutive_number_floor_designations), the local system should be used where possible.';
    public const LABEL = 'floorLevel';
    public const NAME = 'schema:floorLevel';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'LocalBusiness' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LocalBusinessModel', 'Residence' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ResidenceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2373', 'https://github.com/schemaorg/schemaorg/issues/4469'];
    public const SUPERSEDED_BY = null;
}
