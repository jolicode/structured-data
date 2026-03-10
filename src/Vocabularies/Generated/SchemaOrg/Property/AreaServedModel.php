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

final class AreaServedModel
{
    public const DESCRIPTION = 'The geographic area where a service or offered item is provided.';
    public const LABEL = 'areaServed';
    public const NAME = 'schema:areaServed';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AdministrativeAreaModel', 'GeoShapeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel', 'DeliveryChargeSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
