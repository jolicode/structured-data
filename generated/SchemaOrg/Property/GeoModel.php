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

final class GeoModel
{
    public const DESCRIPTION = 'The geo coordinates of the place.';
    public const LABEL = 'geo';
    public const NAME = 'schema:geo';
    public const VALUES = ['GeoCoordinatesModel' => 'SchemaOrg\Type\GeoCoordinatesModel', 'GeoShapeModel' => 'SchemaOrg\Type\GeoShapeModel'];
    public const TYPES = ['Place' => 'SchemaOrg\Type\PlaceModel'];
}
