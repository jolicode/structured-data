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

final class OriginAddressModel
{
    public const DESCRIPTION = 'Shipper\'s address.';
    public const LABEL = 'originAddress';
    public const NAME = 'schema:originAddress';
    public const VALUES = ['PostalAddressModel' => 'SchemaOrg\Type\PostalAddressModel'];
    public const TYPES = ['ParcelDelivery' => 'SchemaOrg\Type\ParcelDeliveryModel'];
}
