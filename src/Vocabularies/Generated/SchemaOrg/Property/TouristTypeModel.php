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

final class TouristTypeModel
{
    public const DESCRIPTION = 'Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc.';
    public const LABEL = 'touristType';
    public const NAME = 'schema:touristType';
    public const VALUES = ['AudienceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudienceModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['TouristAttraction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TouristAttractionModel', 'TouristDestination' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TouristDestinationModel', 'TouristTrip' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TouristTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
