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

final class EligibleRegionModel
{
    public const DESCRIPTION = 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\n\nSee also [[ineligibleRegion]].
    ';
    public const LABEL = 'eligibleRegion';
    public const NAME = 'schema:eligibleRegion';
    public const VALUES = ['GeoShapeModel' => 'Jolicode\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\SchemaOrg\Type\ActionAccessSpecificationModel', 'DeliveryChargeSpecification' => 'Jolicode\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
}
