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

final class GeoDisjointModel
{
    public const DESCRIPTION = 'Represents spatial relations in which two geometries (or the places they represent) are topologically disjoint: "they have no point in common. They form a set of disconnected geometries." (A symmetric relationship, as defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).)';
    public const LABEL = 'geoDisjoint';
    public const NAME = 'schema:geoDisjoint';
    public const VALUES = ['GeospatialGeometryModel' => 'SchemaOrg\\Type\\GeospatialGeometryModel', 'PlaceModel' => 'SchemaOrg\\Type\\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'SchemaOrg\\Type\\GeospatialGeometryModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel'];
}
