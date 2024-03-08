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

final class GeoContainsModel
{
    public const DESCRIPTION = 'Represents a relationship between two geometries (or the places they represent), relating a containing geometry to a contained geometry. "a contains b iff no points of b lie in the exterior of a, and at least one point of the interior of b lies in the interior of a". As defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).';
    public const LABEL = 'geoContains';
    public const NAME = 'schema:geoContains';
    public const VALUES = ['GeospatialGeometryModel' => 'SchemaOrg\\Type\\GeospatialGeometryModel', 'PlaceModel' => 'SchemaOrg\\Type\\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'SchemaOrg\\Type\\GeospatialGeometryModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
