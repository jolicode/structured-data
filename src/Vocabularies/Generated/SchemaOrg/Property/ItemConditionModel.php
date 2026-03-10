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

final class ItemConditionModel
{
    public const DESCRIPTION = 'A predefined value from OfferItemCondition specifying the condition of the product or service, or the products or services included in the offer. Also used for product return policies to specify the condition of products accepted for returns.';
    public const LABEL = 'itemCondition';
    public const NAME = 'schema:itemCondition';
    public const VALUES = ['OfferItemConditionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferItemConditionModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'MerchantReturnPolicy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
