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

final class ElevationModel
{
    public const DESCRIPTION = 'The elevation of a location ([WGS 84](https://en.wikipedia.org/wiki/World_Geodetic_System)). Values may be of the form \'NUMBER UNIT\\_OF\\_MEASUREMENT\' (e.g., \'1,000 m\', \'3,200 ft\') while numbers alone should be assumed to be a value in meters.';
    public const LABEL = 'elevation';
    public const NAME = 'schema:elevation';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'SchemaOrg\\Type\\GeoCoordinatesModel', 'GeoShape' => 'SchemaOrg\\Type\\GeoShapeModel'];
}
