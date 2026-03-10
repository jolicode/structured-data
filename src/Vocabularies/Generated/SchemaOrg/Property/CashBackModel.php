<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class CashBackModel
{
    public const DESCRIPTION = 'A cardholder benefit that pays the cardholder a small percentage of their net expenditures.';
    public const LABEL = 'cashBack';
    public const NAME = 'schema:cashBack';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PaymentCard' => 'Jolicode\Vocabularies\SchemaOrg\Type\PaymentCardModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
