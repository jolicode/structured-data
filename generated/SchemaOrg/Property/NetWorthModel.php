<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class NetWorthModel
{
    public const DESCRIPTION = 'The total financial value of the person as calculated by subtracting assets from liabilities.';
    public const LABEL = 'netWorth';
    public const NAME = 'schema:netWorth';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\Type\MonetaryAmountModel', 'PriceSpecificationModel' => 'SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
