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

final class PaymentMethodModel
{
    public const DESCRIPTION = 'The name of the credit card or other method of payment for the order.';
    public const LABEL = 'paymentMethod';
    public const NAME = 'schema:paymentMethod';
    public const VALUES = ['PaymentMethodModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PaymentMethodModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'Order' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3537'];
    public const SUPERSEDED_BY = null;
}
