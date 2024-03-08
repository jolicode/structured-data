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

final class AreaServedModel
{
    public const DESCRIPTION = 'The geographic area where a service or offered item is provided.';
    public const LABEL = 'areaServed';
    public const NAME = 'schema:areaServed';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'SchemaOrg\Type\PlaceModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'SchemaOrg\Type\ContactPointModel', 'DeliveryChargeSpecification' => 'SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'SchemaOrg\Type\DemandModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Service' => 'SchemaOrg\Type\ServiceModel'];
}
