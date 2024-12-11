<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class AmountModel
{
    public const DESCRIPTION = 'The amount of money.';
    public const LABEL = 'amount';
    public const NAME = 'schema:amount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DatedMoneySpecification' => 'Jolicode\SchemaOrg\Type\DatedMoneySpecificationModel', 'InvestmentOrDeposit' => 'Jolicode\SchemaOrg\Type\InvestmentOrDepositModel', 'LoanOrCredit' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel', 'MonetaryGrant' => 'Jolicode\SchemaOrg\Type\MonetaryGrantModel', 'MoneyTransfer' => 'Jolicode\SchemaOrg\Type\MoneyTransferModel'];
}
