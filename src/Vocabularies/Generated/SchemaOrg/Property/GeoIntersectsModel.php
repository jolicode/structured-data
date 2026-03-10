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

final class GeoIntersectsModel
{
    public const DESCRIPTION = 'Represents spatial relations in which two geometries (or the places they represent) have at least one point in common. As defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).';
    public const LABEL = 'geoIntersects';
    public const NAME = 'schema:geoIntersects';
    public const VALUES = ['GeospatialGeometryModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeospatialGeometryModel', 'PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeospatialGeometryModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
