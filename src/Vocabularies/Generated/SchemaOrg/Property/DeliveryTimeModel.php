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

final class DeliveryTimeModel
{
    public const DESCRIPTION = 'The total delay between the receipt of the order and the goods reaching the final customer.';
    public const LABEL = 'deliveryTime';
    public const NAME = 'schema:deliveryTime';
    public const VALUES = ['ShippingDeliveryTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ShippingDeliveryTimeModel'];
    public const TYPES = ['DeliveryTimeSettings' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DeliveryTimeSettingsModel', 'OfferShippingDetails' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferShippingDetailsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2506'];
    public const SUPERSEDED_BY = null;
}
