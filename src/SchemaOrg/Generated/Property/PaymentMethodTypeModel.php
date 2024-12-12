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

final class PaymentMethodTypeModel
{
    public const DESCRIPTION = 'The type of a payment method.';
    public const LABEL = 'paymentMethodType';
    public const NAME = 'schema:paymentMethodType';
    public const VALUES = ['PaymentMethodTypeModel' => 'Jolicode\SchemaOrg\Type\PaymentMethodTypeModel'];
    public const TYPES = ['PaymentMethod' => 'Jolicode\SchemaOrg\Type\PaymentMethodModel'];
}
