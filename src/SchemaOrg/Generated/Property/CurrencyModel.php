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

final class CurrencyModel
{
    public const DESCRIPTION = 'The currency in which the monetary amount is expressed.\n\nUse standard formats: [ISO 4217 currency format](http://en.wikipedia.org/wiki/ISO_4217), e.g. "USD"; [Ticker symbol](https://en.wikipedia.org/wiki/List_of_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for [Local Exchange Trading Systems](https://en.wikipedia.org/wiki/Local_exchange_trading_system) (LETS) and other currency types, e.g. "Ithaca HOUR".';
    public const LABEL = 'currency';
    public const NAME = 'schema:currency';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DatedMoneySpecification' => 'Jolicode\SchemaOrg\Type\DatedMoneySpecificationModel', 'ExchangeRateSpecification' => 'Jolicode\SchemaOrg\Type\ExchangeRateSpecificationModel', 'LoanOrCredit' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel', 'MonetaryAmountDistribution' => 'Jolicode\SchemaOrg\Type\MonetaryAmountDistributionModel', 'MonetaryAmount' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel'];
}
