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

final class ReturnFeesModel
{
    public const DESCRIPTION = 'The type of return fees for purchased products (for any return reason).';
    public const LABEL = 'returnFees';
    public const NAME = 'schema:returnFees';
    public const VALUES = ['ReturnFeesEnumerationModel' => 'Jolicode\SchemaOrg\Type\ReturnFeesEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
}
