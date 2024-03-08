<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ItemConditionModel
{
    public const DESCRIPTION = 'A predefined value from OfferItemCondition specifying the condition of the product or service, or the products or services included in the offer. Also used for product return policies to specify the condition of products accepted for returns.';
    public const LABEL = 'itemCondition';
    public const NAME = 'schema:itemCondition';
    public const VALUES = ['OfferItemConditionModel' => 'SchemaOrg\Type\OfferItemConditionModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\Type\DemandModel', 'MerchantReturnPolicy' => 'SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
