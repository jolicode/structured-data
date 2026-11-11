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

final class HasProductReturnPolicyModel
{
    public const DESCRIPTION = 'Indicates a ProductReturnPolicy that may be applicable.';
    public const LABEL = 'hasProductReturnPolicy';
    public const NAME = 'schema:hasProductReturnPolicy';
    public const VALUES = ['ProductReturnPolicyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductReturnPolicyModel'];
    public const TYPES = ['Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2288'];
    public const SUPERSEDED_BY = 'hasMerchantReturnPolicy';
}
