<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ExchangeRateSpreadModel
{
    public const DESCRIPTION = 'The difference between the price at which a broker or other intermediary buys and sells foreign currency.';
    public const LABEL = 'exchangeRateSpread';
    public const NAME = 'schema:exchangeRateSpread';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['ExchangeRateSpecification' => 'SchemaOrg\\Type\\ExchangeRateSpecificationModel'];
}
