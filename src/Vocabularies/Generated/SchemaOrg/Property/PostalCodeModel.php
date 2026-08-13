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

final class PostalCodeModel
{
    public const DESCRIPTION = 'The postal code. For example, 94043.';
    public const LABEL = 'postalCode';
    public const NAME = 'schema:postalCode';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DefinedRegion' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedRegionModel', 'GeoCoordinates' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'PostalAddress' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PostalAddressModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;
}
