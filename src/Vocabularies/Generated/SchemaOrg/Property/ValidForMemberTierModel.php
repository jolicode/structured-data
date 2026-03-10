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

final class ValidForMemberTierModel
{
    public const DESCRIPTION = 'The membership program tier an Offer (or a PriceSpecification, OfferShippingDetails, or MerchantReturnPolicy under an Offer) is valid for.';
    public const LABEL = 'validForMemberTier';
    public const NAME = 'schema:validForMemberTier';
    public const VALUES = ['MemberProgramTierModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MemberProgramTierModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'PriceSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel', 'ShippingService' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
