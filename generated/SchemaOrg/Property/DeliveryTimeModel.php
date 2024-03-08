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

final class DeliveryTimeModel
{
    public const DESCRIPTION = 'The total delay between the receipt of the order and the goods reaching the final customer.';
    public const LABEL = 'deliveryTime';
    public const NAME = 'schema:deliveryTime';
    public const VALUES = ['ShippingDeliveryTimeModel' => 'SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const TYPES = ['DeliveryTimeSettings' => 'SchemaOrg\Type\DeliveryTimeSettingsModel', 'OfferShippingDetails' => 'SchemaOrg\Type\OfferShippingDetailsModel'];
}
