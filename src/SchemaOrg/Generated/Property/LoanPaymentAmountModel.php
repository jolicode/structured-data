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

final class LoanPaymentAmountModel
{
    public const DESCRIPTION = 'The amount of money to pay in a single payment.';
    public const LABEL = 'loanPaymentAmount';
    public const NAME = 'schema:loanPaymentAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['RepaymentSpecification' => 'Jolicode\SchemaOrg\Type\RepaymentSpecificationModel'];
}
