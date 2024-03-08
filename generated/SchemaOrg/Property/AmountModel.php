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

final class AmountModel
{
    public const DESCRIPTION = 'The amount of money.';
    public const LABEL = 'amount';
    public const NAME = 'schema:amount';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DatedMoneySpecification' => 'SchemaOrg\Type\DatedMoneySpecificationModel', 'InvestmentOrDeposit' => 'SchemaOrg\Type\InvestmentOrDepositModel', 'LoanOrCredit' => 'SchemaOrg\Type\LoanOrCreditModel', 'MonetaryGrant' => 'SchemaOrg\Type\MonetaryGrantModel', 'MoneyTransfer' => 'SchemaOrg\Type\MoneyTransferModel'];
}
