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

final class PaymentStatusModel
{
    public const DESCRIPTION = 'The status of payment; whether the invoice has been paid or not.';
    public const LABEL = 'paymentStatus';
    public const NAME = 'schema:paymentStatus';
    public const VALUES = ['PaymentStatusTypeModel' => 'SchemaOrg\Type\PaymentStatusTypeModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\Type\InvoiceModel'];
}
