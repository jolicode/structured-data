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

final class BedModel
{
    public const DESCRIPTION = 'The type of bed or beds included in the accommodation. For the single case of just one bed of a certain type, you use bed directly with a text.
      If you want to indicate the quantity of a certain kind of bed, use an instance of BedDetails. For more detailed information, use the amenityFeature property.';
    public const LABEL = 'bed';
    public const NAME = 'schema:bed';
    public const VALUES = ['BedDetailsModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BedDetailsModel', 'BedTypeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BedTypeModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AccommodationModel', 'HotelRoom' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\HotelRoomModel', 'Suite' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SuiteModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
