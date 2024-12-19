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

final class RecourseLoanModel
{
    public const DESCRIPTION = 'The only way you get the money back in the event of default is the security. Recourse is where you still have the opportunity to go back to the borrower for the rest of the money.';
    public const LABEL = 'recourseLoan';
    public const NAME = 'schema:recourseLoan';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
