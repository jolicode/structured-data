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

final class PaymentDueDateModel
{
    public const DESCRIPTION = 'The date that payment is due.';
    public const LABEL = 'paymentDueDate';
    public const NAME = 'schema:paymentDueDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\Type\InvoiceModel', 'Order' => 'SchemaOrg\Type\OrderModel'];
}
