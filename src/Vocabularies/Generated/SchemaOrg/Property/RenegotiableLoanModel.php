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

final class RenegotiableLoanModel
{
    public const DESCRIPTION = 'Whether the terms for payment of interest can be renegotiated during the life of the loan.';
    public const LABEL = 'renegotiableLoan';
    public const NAME = 'schema:renegotiableLoan';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['LoanOrCredit' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
