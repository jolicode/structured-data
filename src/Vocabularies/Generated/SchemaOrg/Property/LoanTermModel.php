<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class LoanTermModel
{
    public const DESCRIPTION = 'The duration of the loan or credit agreement.';
    public const LABEL = 'loanTerm';
    public const NAME = 'schema:loanTerm';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\Vocabularies\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
