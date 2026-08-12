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

final class HandlingTimeModel
{
    public const DESCRIPTION = 'The typical delay between the receipt of the order and the goods either leaving the warehouse or being prepared for pickup, in case the delivery method is on site pickup.

In the context of [[ShippingDeliveryTime]], Typical properties: minValue, maxValue, unitCode (d for DAY).  This is by common convention assumed to mean business days (if a unitCode is used, coded as "d"), i.e. only counting days when the business normally operates.

In the context of [[ShippingService]], use the [[ServicePeriod]] format, that contains the same information in a structured form, with cut-off time, business days and duration.';
    public const LABEL = 'handlingTime';
    public const NAME = 'schema:handlingTime';
    public const VALUES = ['QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel', 'ServicePeriodModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServicePeriodModel'];
    public const TYPES = ['ShippingDeliveryTime' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingDeliveryTimeModel', 'ShippingService' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506', 'https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
