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

final class ValidForMemberTierModel
{
    public const DESCRIPTION = 'The membership program tier(s) an Offer (or a PriceSpecification, OfferShippingDetails, or MerchantReturnPolicy under an Offer) is valid for.';
    public const LABEL = 'validForMemberTier';
    public const NAME = 'schema:validForMemberTier';
    public const VALUES = ['MemberProgramTierModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MemberProgramTierModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'OfferShippingDetails' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferShippingDetailsModel', 'PriceSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel', 'ShippingService' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingServiceModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3563', 'https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
