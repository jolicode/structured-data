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

final class PurchasePriceLimitModel
{
    public const DESCRIPTION = 'Optional. The maximum price the item can have and still qualify for this offer.';
    public const LABEL = 'purchasePriceLimit';
    public const NAME = 'schema:purchasePriceLimit';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['FinancialIncentive' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;
}
