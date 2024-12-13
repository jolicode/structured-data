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

final class AreaServedModel
{
    public const DESCRIPTION = 'The geographic area where a service or offered item is provided.';
    public const LABEL = 'areaServed';
    public const NAME = 'schema:areaServed';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'Jolicode\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\SchemaOrg\Type\ContactPointModel', 'DeliveryChargeSpecification' => 'Jolicode\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
