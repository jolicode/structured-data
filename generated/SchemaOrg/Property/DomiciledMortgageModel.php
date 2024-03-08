<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DomiciledMortgageModel
{
    public const DESCRIPTION = 'Whether borrower is a resident of the jurisdiction where the property is located.';
    public const LABEL = 'domiciledMortgage';
    public const NAME = 'schema:domiciledMortgage';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['MortgageLoan' => 'SchemaOrg\\Type\\MortgageLoanModel'];
}
