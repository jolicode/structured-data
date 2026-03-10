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

final class MonthlyMinimumRepaymentAmountModel
{
    public const DESCRIPTION = 'The minimum payment is the lowest amount of money that one is required to pay on a credit card statement each month.';
    public const LABEL = 'monthlyMinimumRepaymentAmount';
    public const NAME = 'schema:monthlyMinimumRepaymentAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PaymentCard' => 'Jolicode\Vocabularies\SchemaOrg\Type\PaymentCardModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
