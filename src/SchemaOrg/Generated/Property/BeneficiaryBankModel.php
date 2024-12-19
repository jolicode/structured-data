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

final class BeneficiaryBankModel
{
    public const DESCRIPTION = 'A bank or bank’s branch, financial institution or international financial institution operating the beneficiary’s bank account or releasing funds for the beneficiary.';
    public const LABEL = 'beneficiaryBank';
    public const NAME = 'schema:beneficiaryBank';
    public const VALUES = ['BankOrCreditUnionModel' => 'Jolicode\SchemaOrg\Type\BankOrCreditUnionModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MoneyTransfer' => 'Jolicode\SchemaOrg\Type\MoneyTransferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
