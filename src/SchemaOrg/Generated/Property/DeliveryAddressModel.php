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

final class DeliveryAddressModel
{
    public const DESCRIPTION = 'Destination address.';
    public const LABEL = 'deliveryAddress';
    public const NAME = 'schema:deliveryAddress';
    public const VALUES = ['PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel'];
    public const TYPES = ['ParcelDelivery' => 'Jolicode\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
