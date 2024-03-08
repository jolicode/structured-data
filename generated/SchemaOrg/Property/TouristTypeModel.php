<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TouristTypeModel
{
    public const DESCRIPTION = 'Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc. ';
    public const LABEL = 'touristType';
    public const NAME = 'schema:touristType';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\\Type\\AudienceModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['TouristAttraction' => 'SchemaOrg\\Type\\TouristAttractionModel', 'TouristDestination' => 'SchemaOrg\\Type\\TouristDestinationModel', 'TouristTrip' => 'SchemaOrg\\Type\\TouristTripModel'];
}
