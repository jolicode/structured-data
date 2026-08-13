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

final class ServiceAreaModel
{
    public const DESCRIPTION = 'The geographic area where the service is provided.';
    public const LABEL = 'serviceArea';
    public const NAME = 'schema:serviceArea';
    public const VALUES = ['AdministrativeAreaModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ContactPoint' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Service' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'areaServed';
}
