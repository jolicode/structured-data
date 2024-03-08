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

final class LoanPaymentFrequencyModel
{
    public const DESCRIPTION = 'Frequency of payments due, i.e. number of months between payments. This is defined as a frequency, i.e. the reciprocal of a period of time.';
    public const LABEL = 'loanPaymentFrequency';
    public const NAME = 'schema:loanPaymentFrequency';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['RepaymentSpecification' => 'SchemaOrg\Type\RepaymentSpecificationModel'];
}
