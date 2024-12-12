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

final class ValidForMemberTierModel
{
    public const DESCRIPTION = 'The membership program tier an Offer (or a PriceSpecification, OfferShippingDetails, or MerchantReturnPolicy under an Offer) is valid for.';
    public const LABEL = 'validForMemberTier';
    public const NAME = 'schema:validForMemberTier';
    public const VALUES = ['MemberProgramTierModel' => 'Jolicode\SchemaOrg\Type\MemberProgramTierModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel', 'PriceSpecification' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
}
