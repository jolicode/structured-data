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

final class OrderDeliveryModel
{
    public const DESCRIPTION = 'The delivery of the parcel related to this order or order item.';
    public const LABEL = 'orderDelivery';
    public const NAME = 'schema:orderDelivery';
    public const VALUES = ['ParcelDeliveryModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ParcelDeliveryModel'];
    public const TYPES = ['OrderItem' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderItemModel', 'Order' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
