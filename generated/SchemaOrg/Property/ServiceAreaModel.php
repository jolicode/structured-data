<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ServiceAreaModel
{
    public const DESCRIPTION = 'The geographic area where the service is provided.';
    public const LABEL = 'serviceArea';
    public const NAME = 'schema:serviceArea';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ContactPoint' => 'SchemaOrg\Type\ContactPointModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Service' => 'SchemaOrg\Type\ServiceModel'];
}
