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

final class EarlyPrepaymentPenaltyModel
{
    public const DESCRIPTION = 'The amount to be paid as a penalty in the event of early payment of the loan.';
    public const LABEL = 'earlyPrepaymentPenalty';
    public const NAME = 'schema:earlyPrepaymentPenalty';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['RepaymentSpecification' => 'SchemaOrg\Type\RepaymentSpecificationModel'];
}
