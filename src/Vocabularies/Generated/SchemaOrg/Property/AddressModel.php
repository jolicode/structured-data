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

final class AddressModel
{
    public const DESCRIPTION = 'Physical address of the item.';
    public const LABEL = 'address';
    public const NAME = 'schema:address';
    public const VALUES = ['PostalAddressModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PostalAddressModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GeoCoordinates' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoCoordinatesModel', 'GeoShape' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'Place' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
