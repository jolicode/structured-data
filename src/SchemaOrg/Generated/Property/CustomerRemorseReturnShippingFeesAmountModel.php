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

final class CustomerRemorseReturnShippingFeesAmountModel
{
    public const DESCRIPTION = 'The amount of shipping costs if a product is returned due to customer remorse. Applicable when property [[customerRemorseReturnFees]] equals [[ReturnShippingFees]].';
    public const LABEL = 'customerRemorseReturnShippingFeesAmount';
    public const NAME = 'schema:customerRemorseReturnShippingFeesAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
