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

final class GeoCrossesModel
{
    public const DESCRIPTION = 'Represents a relationship between two geometries (or the places they represent), relating a geometry to another that crosses it: "a crosses b: they have some but not all interior points in common, and the dimension of the intersection is less than that of at least one of them". As defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).';
    public const LABEL = 'geoCrosses';
    public const NAME = 'schema:geoCrosses';
    public const VALUES = ['GeospatialGeometryModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeospatialGeometryModel', 'PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeospatialGeometryModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
