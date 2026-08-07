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

final class ContactlessPaymentModel
{
    public const DESCRIPTION = 'A secure method for consumers to purchase products or services via debit, credit or smartcards by using RFID or NFC technology.';
    public const LABEL = 'contactlessPayment';
    public const NAME = 'schema:contactlessPayment';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PaymentCard' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PaymentCardModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
