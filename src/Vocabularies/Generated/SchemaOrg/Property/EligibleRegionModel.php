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

final class EligibleRegionModel
{
    public const DESCRIPTION = 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\n\nSee also [[ineligibleRegion]].';
    public const LABEL = 'eligibleRegion';
    public const NAME = 'schema:eligibleRegion';
    public const VALUES = ['GeoShapeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ActionAccessSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ActionAccessSpecificationModel', 'DeliveryChargeSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1741'];
    public const SUPERSEDED_BY = null;
}
