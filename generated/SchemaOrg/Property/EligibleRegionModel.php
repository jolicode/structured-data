<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class EligibleRegionModel
{
    public const DESCRIPTION = 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\\n\\nSee also [[ineligibleRegion]].
    ';
    public const LABEL = 'eligibleRegion';
    public const NAME = 'schema:eligibleRegion';
    public const VALUES = ['GeoShapeModel' => 'SchemaOrg\\Type\\GeoShapeModel', 'PlaceModel' => 'SchemaOrg\\Type\\PlaceModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['ActionAccessSpecification' => 'SchemaOrg\\Type\\ActionAccessSpecificationModel', 'DeliveryChargeSpecification' => 'SchemaOrg\\Type\\DeliveryChargeSpecificationModel', 'Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel'];
}
