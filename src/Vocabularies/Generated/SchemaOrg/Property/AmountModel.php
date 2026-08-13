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

final class AmountModel
{
    public const DESCRIPTION = 'The amount of money.';
    public const LABEL = 'amount';
    public const NAME = 'schema:amount';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DatedMoneySpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatedMoneySpecificationModel', 'InvestmentOrDeposit' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvestmentOrDepositModel', 'LoanOrCredit' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LoanOrCreditModel', 'MonetaryGrant' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryGrantModel', 'MoneyTransfer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MoneyTransferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253', 'https://github.com/schemaorg/schemaorg/issues/1698'];
    public const SUPERSEDED_BY = null;
}
