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

final class PaymentUrlModel
{
    public const DESCRIPTION = 'The URL for sending a payment.';
    public const LABEL = 'paymentUrl';
    public const NAME = 'schema:paymentUrl';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Order' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
