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

final class AccountIdModel
{
    public const DESCRIPTION = 'The identifier for the account the payment will be applied to.';
    public const LABEL = 'accountId';
    public const NAME = 'schema:accountId';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\Type\InvoiceModel'];
}
