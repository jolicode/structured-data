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

final class CustomerRemorseReturnFeesModel
{
    public const DESCRIPTION = 'The type of return fees if the product is returned due to customer remorse.';
    public const LABEL = 'customerRemorseReturnFees';
    public const NAME = 'schema:customerRemorseReturnFees';
    public const VALUES = ['ReturnFeesEnumerationModel' => 'SchemaOrg\\Type\\ReturnFeesEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\\Type\\MerchantReturnPolicyModel'];
}
