<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ServiceAreaModel
{
    public const DESCRIPTION = 'The geographic area where the service is provided.';
    public const LABEL = 'serviceArea';
    public const NAME = 'schema:serviceArea';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'Jolicode\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
}
