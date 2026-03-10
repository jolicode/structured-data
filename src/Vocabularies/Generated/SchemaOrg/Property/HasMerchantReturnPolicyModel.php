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

final class HasMerchantReturnPolicyModel
{
    public const DESCRIPTION = 'Specifies a MerchantReturnPolicy that may be applicable.';
    public const LABEL = 'hasMerchantReturnPolicy';
    public const NAME = 'schema:hasMerchantReturnPolicy';
    public const VALUES = ['MerchantReturnPolicyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const TYPES = ['Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
