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

final class GeoEqualsModel
{
    public const DESCRIPTION = 'Represents spatial relations in which two geometries (or the places they represent) are topologically equal, as defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM). "Two geometries are topologically equal if their interiors intersect and no part of the interior or boundary of one geometry intersects the exterior of the other" (a symmetric relationship).';
    public const LABEL = 'geoEquals';
    public const NAME = 'schema:geoEquals';
    public const VALUES = ['GeospatialGeometryModel' => 'Jolicode\SchemaOrg\Type\GeospatialGeometryModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'Jolicode\SchemaOrg\Type\GeospatialGeometryModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
