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

final class AppliesToDeliveryMethodModel
{
    public const DESCRIPTION = 'The delivery method(s) to which the delivery charge or payment charge specification applies.';
    public const LABEL = 'appliesToDeliveryMethod';
    public const NAME = 'schema:appliesToDeliveryMethod';
    public const VALUES = ['DeliveryMethodModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryMethodModel'];
    public const TYPES = ['DeliveryChargeSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryChargeSpecificationModel', 'PaymentChargeSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\PaymentChargeSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
