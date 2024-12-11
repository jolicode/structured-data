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

final class CurrentExchangeRateModel
{
    public const DESCRIPTION = 'The current price of a currency.';
    public const LABEL = 'currentExchangeRate';
    public const NAME = 'schema:currentExchangeRate';
    public const VALUES = ['UnitPriceSpecificationModel' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const TYPES = ['ExchangeRateSpecification' => 'Jolicode\SchemaOrg\Type\ExchangeRateSpecificationModel'];
}
