<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class PaymentDueModel
{
    public const DESCRIPTION = 'The date that payment is due.';
    public const LABEL = 'paymentDue';
    public const NAME = 'schema:paymentDue';
    public const VALUES = ['DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Invoice' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
