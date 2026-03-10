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

final class ElevationModel
{
    public const DESCRIPTION = 'The elevation of a location ([WGS 84](https://en.wikipedia.org/wiki/World_Geodetic_System)). Values may be of the form \'NUMBER UNIT\_OF\_MEASUREMENT\' (e.g., \'1,000 m\', \'3,200 ft\') while numbers alone should be assumed to be a value in meters.';
    public const LABEL = 'elevation';
    public const NAME = 'schema:elevation';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoShapeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
