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

final class ItemPopularityModel
{
    public const DESCRIPTION = 'A measure of the relative popularity or sales rank of the offer within a marketplace, catalog, or platform (e.g. a platform-specific bestseller ranking or sales rank). This property is intended for platform-level or catalog-wide comparative rankings rather than self-asserted promotional claims.';
    public const LABEL = 'itemPopularity';
    public const NAME = 'schema:itemPopularity';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4878'];
    public const SUPERSEDED_BY = null;
}
