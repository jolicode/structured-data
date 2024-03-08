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

final class PaymentMethodIdModel
{
    public const DESCRIPTION = 'An identifier for the method of payment used (e.g. the last 4 digits of the credit card).';
    public const LABEL = 'paymentMethodId';
    public const NAME = 'schema:paymentMethodId';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\\Type\\InvoiceModel', 'Order' => 'SchemaOrg\\Type\\OrderModel'];
}
