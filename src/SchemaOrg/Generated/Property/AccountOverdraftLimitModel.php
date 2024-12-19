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

final class AccountOverdraftLimitModel
{
    public const DESCRIPTION = 'An overdraft is an extension of credit from a lending institution when an account reaches zero. An overdraft allows the individual to continue withdrawing money even if the account has no funds in it. Basically the bank allows people to borrow a set amount of money.';
    public const LABEL = 'accountOverdraftLimit';
    public const NAME = 'schema:accountOverdraftLimit';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['BankAccount' => 'Jolicode\SchemaOrg\Type\BankAccountModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
