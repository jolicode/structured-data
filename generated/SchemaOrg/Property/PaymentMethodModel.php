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

final class PaymentMethodModel
{
    public const DESCRIPTION = 'The name of the credit card or other method of payment for the order.';
    public const LABEL = 'paymentMethod';
    public const NAME = 'schema:paymentMethod';
    public const VALUES = ['PaymentMethodModel' => 'SchemaOrg\Type\PaymentMethodModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\Type\InvoiceModel', 'Order' => 'SchemaOrg\Type\OrderModel'];
}
