<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class LongitudeModel
{
    public const DESCRIPTION = 'The longitude of a location. For example ```-122.08585``` ([WGS 84](https://en.wikipedia.org/wiki/World_Geodetic_System)).';
    public const LABEL = 'longitude';
    public const NAME = 'schema:longitude';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'SchemaOrg\Type\GeoCoordinatesModel', 'Place' => 'SchemaOrg\Type\PlaceModel'];
}
