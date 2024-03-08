<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class TransitTimeModel
{
    public const DESCRIPTION = 'The typical delay the order has been sent for delivery and the goods reach the final customer. Typical properties: minValue, maxValue, unitCode (d for DAY).';
    public const LABEL = 'transitTime';
    public const NAME = 'schema:transitTime';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ShippingDeliveryTime' => 'SchemaOrg\Type\ShippingDeliveryTimeModel'];
}
