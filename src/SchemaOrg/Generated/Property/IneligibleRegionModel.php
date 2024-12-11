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

final class IneligibleRegionModel
{
    public const DESCRIPTION = 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\n\nSee also [[eligibleRegion]].
      ';
    public const LABEL = 'ineligibleRegion';
    public const NAME = 'schema:ineligibleRegion';
    public const VALUES = ['GeoShapeModel' => 'Jolicode\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\SchemaOrg\Type\ActionAccessSpecificationModel', 'DeliveryChargeSpecification' => 'Jolicode\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
}
