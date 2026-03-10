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

final class AccountMinimumInflowModel
{
    public const DESCRIPTION = 'A minimum amount that has to be paid in every month.';
    public const LABEL = 'accountMinimumInflow';
    public const NAME = 'schema:accountMinimumInflow';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['BankAccount' => 'Jolicode\Vocabularies\SchemaOrg\Type\BankAccountModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
