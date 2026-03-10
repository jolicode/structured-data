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

final class ItemDefectReturnShippingFeesAmountModel
{
    public const DESCRIPTION = 'Amount of shipping costs for defect product returns. Applicable when property [[itemDefectReturnFees]] equals [[ReturnShippingFees]].';
    public const LABEL = 'itemDefectReturnShippingFeesAmount';
    public const NAME = 'schema:itemDefectReturnShippingFeesAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
