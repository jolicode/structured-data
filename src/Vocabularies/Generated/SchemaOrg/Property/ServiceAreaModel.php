<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ServiceAreaModel
{
    public const DESCRIPTION = 'The geographic area where the service is provided.';
    public const LABEL = 'serviceArea';
    public const NAME = 'schema:serviceArea';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Service' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'areaServed';
}
