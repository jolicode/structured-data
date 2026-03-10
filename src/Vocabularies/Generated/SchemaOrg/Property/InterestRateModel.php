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

final class InterestRateModel
{
    public const DESCRIPTION = 'The interest rate, charged or paid, applicable to the financial product. Note: This is different from the calculated annualPercentageRate.';
    public const LABEL = 'interestRate';
    public const NAME = 'schema:interestRate';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['FinancialProduct' => 'Jolicode\Vocabularies\SchemaOrg\Type\FinancialProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
