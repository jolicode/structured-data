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

final class PaymentDueModel
{
    public const DESCRIPTION = 'The date that payment is due.';
    public const LABEL = 'paymentDue';
    public const NAME = 'schema:paymentDue';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\\Type\\InvoiceModel', 'Order' => 'SchemaOrg\\Type\\OrderModel'];
}
