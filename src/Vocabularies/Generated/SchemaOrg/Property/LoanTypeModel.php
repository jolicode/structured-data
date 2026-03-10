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

final class LoanTypeModel
{
    public const DESCRIPTION = 'The type of a loan or credit.';
    public const LABEL = 'loanType';
    public const NAME = 'schema:loanType';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\Vocabularies\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
