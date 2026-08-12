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

final class DomiciledMortgageModel
{
    public const DESCRIPTION = 'Whether borrower is a resident of the jurisdiction where the property is located.';
    public const LABEL = 'domiciledMortgage';
    public const NAME = 'schema:domiciledMortgage';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['MortgageLoan' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MortgageLoanModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
