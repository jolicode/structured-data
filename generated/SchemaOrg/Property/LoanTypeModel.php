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

final class LoanTypeModel
{
    public const DESCRIPTION = 'The type of a loan or credit.';
    public const LABEL = 'loanType';
    public const NAME = 'schema:loanType';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['LoanOrCredit' => 'SchemaOrg\Type\LoanOrCreditModel'];
}
