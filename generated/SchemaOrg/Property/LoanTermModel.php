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

final class LoanTermModel
{
    public const DESCRIPTION = 'The duration of the loan or credit agreement.';
    public const LABEL = 'loanTerm';
    public const NAME = 'schema:loanTerm';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['LoanOrCredit' => 'SchemaOrg\\Type\\LoanOrCreditModel'];
}
