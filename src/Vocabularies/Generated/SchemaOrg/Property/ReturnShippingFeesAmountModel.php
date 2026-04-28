<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ReturnShippingFeesAmountModel
{
    public const DESCRIPTION = 'Amount of shipping costs for product returns (for any reason). Applicable when property [[returnFees]] equals [[ReturnShippingFees]].';
    public const LABEL = 'returnShippingFeesAmount';
    public const NAME = 'schema:returnShippingFeesAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
