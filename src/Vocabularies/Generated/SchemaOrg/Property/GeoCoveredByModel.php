<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class GeoCoveredByModel
{
    public const DESCRIPTION = 'Represents a relationship between two geometries (or the places they represent), relating a geometry to another that covers it. As defined in [DE-9IM](https://en.wikipedia.org/wiki/DE-9IM).';
    public const LABEL = 'geoCoveredBy';
    public const NAME = 'schema:geoCoveredBy';
    public const VALUES = ['GeospatialGeometryModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeospatialGeometryModel', 'PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['GeospatialGeometry' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeospatialGeometryModel', 'Place' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
