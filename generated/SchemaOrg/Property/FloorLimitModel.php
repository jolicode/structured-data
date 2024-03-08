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

final class FloorLimitModel
{
    public const DESCRIPTION = 'A floor limit is the amount of money above which credit card transactions must be authorized.';
    public const LABEL = 'floorLimit';
    public const NAME = 'schema:floorLimit';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\\Type\\MonetaryAmountModel'];
    public const TYPES = ['PaymentCard' => 'SchemaOrg\\Type\\PaymentCardModel'];
}
