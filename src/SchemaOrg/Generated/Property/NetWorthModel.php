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

final class NetWorthModel
{
    public const DESCRIPTION = 'The total financial value of the person as calculated by subtracting the total value of liabilities from the total value of assets.';
    public const LABEL = 'netWorth';
    public const NAME = 'schema:netWorth';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'PriceSpecificationModel' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
