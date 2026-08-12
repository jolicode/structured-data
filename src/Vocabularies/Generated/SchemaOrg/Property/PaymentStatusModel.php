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

final class PaymentStatusModel
{
    public const DESCRIPTION = 'The status of payment; whether the invoice has been paid or not.';
    public const LABEL = 'paymentStatus';
    public const NAME = 'schema:paymentStatus';
    public const VALUES = ['PaymentStatusTypeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PaymentStatusTypeModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
