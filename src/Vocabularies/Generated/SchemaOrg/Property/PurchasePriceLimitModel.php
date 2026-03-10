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

final class PurchasePriceLimitModel
{
    public const DESCRIPTION = 'Optional. The maximum price the item can have and still qualify for this offer.';
    public const LABEL = 'purchasePriceLimit';
    public const NAME = 'schema:purchasePriceLimit';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
