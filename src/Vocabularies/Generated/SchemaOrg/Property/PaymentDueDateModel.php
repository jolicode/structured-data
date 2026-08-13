<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PaymentDueDateModel
{
    public const DESCRIPTION = 'The date that payment is due.';
    public const LABEL = 'paymentDueDate';
    public const NAME = 'schema:paymentDueDate';
    public const VALUES = ['DateModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Invoice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'Order' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
