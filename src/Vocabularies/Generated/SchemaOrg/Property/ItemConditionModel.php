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

final class ItemConditionModel
{
    public const DESCRIPTION = 'A predefined value from OfferItemCondition specifying the condition of the product or service, or the products or services included in the offer. Also used for product return policies to specify the condition of products accepted for returns.';
    public const LABEL = 'itemCondition';
    public const NAME = 'schema:itemCondition';
    public const VALUES = ['OfferItemConditionModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferItemConditionModel'];
    public const TYPES = ['Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'MerchantReturnPolicy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
