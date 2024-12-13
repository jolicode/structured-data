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

final class PaymentDueDateModel
{
    public const DESCRIPTION = 'The date that payment is due.';
    public const LABEL = 'paymentDueDate';
    public const NAME = 'schema:paymentDueDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
