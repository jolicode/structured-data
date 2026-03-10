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

final class RestockingFeeModel
{
    public const DESCRIPTION = 'Use [[MonetaryAmount]] to specify a fixed restocking fee for product returns, or use [[Number]] to specify a percentage of the product price paid by the customer.';
    public const LABEL = 'restockingFee';
    public const NAME = 'schema:restockingFee';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
