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

final class HandlingTimeModel
{
    public const DESCRIPTION = 'The typical delay between the receipt of the order and the goods either leaving the warehouse or being prepared for pickup, in case the delivery method is on site pickup. Typical properties: minValue, maxValue, unitCode (d for DAY).  This is by common convention assumed to mean business days (if a unitCode is used, coded as "d"), i.e. only counting days when the business normally operates.';
    public const LABEL = 'handlingTime';
    public const NAME = 'schema:handlingTime';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ShippingDeliveryTime' => 'Jolicode\SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
