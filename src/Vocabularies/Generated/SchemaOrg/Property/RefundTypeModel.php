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

final class RefundTypeModel
{
    public const DESCRIPTION = 'A refund type, from an enumerated list.';
    public const LABEL = 'refundType';
    public const NAME = 'schema:refundType';
    public const VALUES = ['RefundTypeEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RefundTypeEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2288'];
    public const SUPERSEDED_BY = null;
}
