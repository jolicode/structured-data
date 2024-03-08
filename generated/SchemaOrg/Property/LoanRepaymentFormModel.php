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

final class LoanRepaymentFormModel
{
    public const DESCRIPTION = 'A form of paying back money previously borrowed from a lender. Repayment usually takes the form of periodic payments that normally include part principal plus interest in each payment.';
    public const LABEL = 'loanRepaymentForm';
    public const NAME = 'schema:loanRepaymentForm';
    public const VALUES = ['RepaymentSpecificationModel' => 'SchemaOrg\\Type\\RepaymentSpecificationModel'];
    public const TYPES = ['LoanOrCredit' => 'SchemaOrg\\Type\\LoanOrCreditModel'];
}
