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

final class AmountModel
{
    public const DESCRIPTION = 'The amount of money.';
    public const LABEL = 'amount';
    public const NAME = 'schema:amount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DatedMoneySpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\DatedMoneySpecificationModel', 'InvestmentOrDeposit' => 'Jolicode\Vocabularies\SchemaOrg\Type\InvestmentOrDepositModel', 'LoanOrCredit' => 'Jolicode\Vocabularies\SchemaOrg\Type\LoanOrCreditModel', 'MonetaryGrant' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryGrantModel', 'MoneyTransfer' => 'Jolicode\Vocabularies\SchemaOrg\Type\MoneyTransferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
