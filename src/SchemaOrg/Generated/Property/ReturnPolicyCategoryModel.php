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

final class ReturnPolicyCategoryModel
{
    public const DESCRIPTION = 'Specifies an applicable return policy (from an enumeration).';
    public const LABEL = 'returnPolicyCategory';
    public const NAME = 'schema:returnPolicyCategory';
    public const VALUES = ['MerchantReturnEnumerationModel' => 'Jolicode\SchemaOrg\Type\MerchantReturnEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
}
