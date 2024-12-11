<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class GeoWithinModel
{
    public const DESCRIPTION = 'Represents a relationship between two geometries (or the places they represent), relating a geometry to one that contains it, i.e. it is inside (i.e. within) its interior. As defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).';
    public const LABEL = 'geoWithin';
    public const NAME = 'schema:geoWithin';
    public const VALUES = ['GeospatialGeometryModel' => 'Jolicode\SchemaOrg\Type\GeospatialGeometryModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'Jolicode\SchemaOrg\Type\GeospatialGeometryModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
}
