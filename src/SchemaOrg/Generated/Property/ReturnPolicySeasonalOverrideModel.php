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

final class ReturnPolicySeasonalOverrideModel
{
    public const DESCRIPTION = 'Seasonal override of a return policy.';
    public const LABEL = 'returnPolicySeasonalOverride';
    public const NAME = 'schema:returnPolicySeasonalOverride';
    public const VALUES = ['MerchantReturnPolicySeasonalOverrideModel' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel'];
}
