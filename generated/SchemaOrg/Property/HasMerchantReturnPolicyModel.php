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

final class HasMerchantReturnPolicyModel
{
    public const DESCRIPTION = 'Specifies a MerchantReturnPolicy that may be applicable.';
    public const LABEL = 'hasMerchantReturnPolicy';
    public const NAME = 'schema:hasMerchantReturnPolicy';
    public const VALUES = ['MerchantReturnPolicyModel' => 'SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const TYPES = ['Offer' => 'SchemaOrg\Type\OfferModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
