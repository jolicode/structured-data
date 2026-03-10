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

final class IncomeLimitModel
{
    public const DESCRIPTION = 'Optional. Income limit for which the incentive is applicable for.
    
<p>If MonetaryAmount is specified, this should be based on annualized income (e.g. if an incentive is limited to those making <$114,000 annually):</p>
    {
        "@type": "MonetaryAmount",
        "maxValue": 114000,
        "currency": "USD",
    }

Use Text for incentives that are limited based on other criteria, for example if an incentive is only available to recipients making 120% of the median poverty income in their area.';
    public const LABEL = 'incomeLimit';
    public const NAME = 'schema:incomeLimit';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
