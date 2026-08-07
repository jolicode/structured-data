<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class LoanRepaymentFormModel
{
    public const DESCRIPTION = 'A form of paying back money previously borrowed from a lender. Repayment usually takes the form of periodic payments that normally include part principal plus interest in each payment.';
    public const LABEL = 'loanRepaymentForm';
    public const NAME = 'schema:loanRepaymentForm';
    public const VALUES = ['RepaymentSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RepaymentSpecificationModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
