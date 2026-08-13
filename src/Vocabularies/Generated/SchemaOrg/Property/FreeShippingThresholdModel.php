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

final class FreeShippingThresholdModel
{
    public const DESCRIPTION = 'A monetary value above (or at) which the shipping rate becomes free. Intended to be used via an [[OfferShippingDetails]] with [[shippingSettingsLink]] matching this [[ShippingRateSettings]].';
    public const LABEL = 'freeShippingThreshold';
    public const NAME = 'schema:freeShippingThreshold';
    public const VALUES = ['DeliveryChargeSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['ShippingRateSettings' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;
}
