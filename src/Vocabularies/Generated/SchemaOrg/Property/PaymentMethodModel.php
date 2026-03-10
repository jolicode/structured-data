<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class PaymentMethodModel
{
    public const DESCRIPTION = 'The name of the credit card or other method of payment for the order.';
    public const LABEL = 'paymentMethod';
    public const NAME = 'schema:paymentMethod';
    public const VALUES = ['PaymentMethodModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PaymentMethodModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'Jolicode\Vocabularies\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
