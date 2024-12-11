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

final class CashBackModel
{
    public const DESCRIPTION = 'A cardholder benefit that pays the cardholder a small percentage of their net expenditures.';
    public const LABEL = 'cashBack';
    public const NAME = 'schema:cashBack';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel', 'NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PaymentCard' => 'Jolicode\SchemaOrg\Type\PaymentCardModel'];
}
