<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class LoanTypeModel
{
    public const DESCRIPTION = 'The type of a loan or credit.';
    public const LABEL = 'loanType';
    public const NAME = 'schema:loanType';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel'];
}
