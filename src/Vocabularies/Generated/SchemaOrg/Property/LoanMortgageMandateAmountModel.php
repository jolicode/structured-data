<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class LoanMortgageMandateAmountModel
{
    public const DESCRIPTION = 'Amount of mortgage mandate that can be converted into a proper mortgage at a later stage.';
    public const LABEL = 'loanMortgageMandateAmount';
    public const NAME = 'schema:loanMortgageMandateAmount';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['MortgageLoan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MortgageLoanModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
