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

final class TransitTimeModel
{
    public const DESCRIPTION = 'The typical delay the order has been sent for delivery and the goods reach the final customer.

  In the context of [[ShippingDeliveryTime]], use the [[QuantitativeValue]]. Typical properties: minValue, maxValue, unitCode (d for DAY).

  In the context of [[ShippingConditions]], use the [[ServicePeriod]]. It has a duration (as a [[QuantitativeValue]]) and also business days and a cut-off time.';
    public const LABEL = 'transitTime';
    public const NAME = 'schema:transitTime';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'ServicePeriodModel' => 'Jolicode\SchemaOrg\Type\ServicePeriodModel'];
    public const TYPES = ['ShippingConditions' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel', 'ShippingDeliveryTime' => 'Jolicode\SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
