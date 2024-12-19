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

final class BankAccountTypeModel
{
    public const DESCRIPTION = 'The type of a bank account.';
    public const LABEL = 'bankAccountType';
    public const NAME = 'schema:bankAccountType';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BankAccount' => 'Jolicode\SchemaOrg\Type\BankAccountModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
