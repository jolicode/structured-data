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

final class MerchantReturnDaysModel
{
    public const DESCRIPTION = 'Specifies either a fixed return date or the number of days (from the delivery date) that a product can be returned. Used when the [[returnPolicyCategory]] property is specified as [[MerchantReturnFiniteReturnWindow]].';
    public const LABEL = 'merchantReturnDays';
    public const NAME = 'schema:merchantReturnDays';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel', 'IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\\Type\\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'SchemaOrg\\Type\\MerchantReturnPolicySeasonalOverrideModel'];
}
