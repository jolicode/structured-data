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

final class TouristTypeModel
{
    public const DESCRIPTION = 'Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc.';
    public const LABEL = 'touristType';
    public const NAME = 'schema:touristType';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudienceModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['TouristAttraction' => 'Jolicode\Vocabularies\SchemaOrg\Type\TouristAttractionModel', 'TouristDestination' => 'Jolicode\Vocabularies\SchemaOrg\Type\TouristDestinationModel', 'TouristTrip' => 'Jolicode\Vocabularies\SchemaOrg\Type\TouristTripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
