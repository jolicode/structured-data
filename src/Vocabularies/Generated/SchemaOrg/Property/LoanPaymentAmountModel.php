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

final class LoanPaymentAmountModel
{
    public const DESCRIPTION = 'The amount of money to pay in a single payment.';
    public const LABEL = 'loanPaymentAmount';
    public const NAME = 'schema:loanPaymentAmount';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['RepaymentSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RepaymentSpecificationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
