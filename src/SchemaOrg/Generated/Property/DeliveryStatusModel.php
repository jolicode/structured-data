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

final class DeliveryStatusModel
{
    public const DESCRIPTION = 'New entry added as the package passes through each leg of its journey (from shipment to final delivery).';
    public const LABEL = 'deliveryStatus';
    public const NAME = 'schema:deliveryStatus';
    public const VALUES = ['DeliveryEventModel' => 'Jolicode\SchemaOrg\Type\DeliveryEventModel'];
    public const TYPES = ['ParcelDelivery' => 'Jolicode\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
