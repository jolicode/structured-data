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

final class FloorLimitModel
{
    public const DESCRIPTION = 'A floor limit is the amount of money above which credit card transactions must be authorized.';
    public const LABEL = 'floorLimit';
    public const NAME = 'schema:floorLimit';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['PaymentCard' => 'Jolicode\SchemaOrg\Type\PaymentCardModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
