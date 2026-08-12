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

final class IneligibleRegionModel
{
    public const DESCRIPTION = 'The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\n\nSee also [[eligibleRegion]].';
    public const LABEL = 'ineligibleRegion';
    public const NAME = 'schema:ineligibleRegion';
    public const VALUES = ['GeoShapeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\GeoShapeModel', 'PlaceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PlaceModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ActionAccessSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ActionAccessSpecificationModel', 'DeliveryChargeSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'MediaObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2242'];
    public const SUPERSEDED_BY = null;
}
