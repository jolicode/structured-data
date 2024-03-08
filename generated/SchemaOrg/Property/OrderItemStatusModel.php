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

final class OrderItemStatusModel
{
    public const DESCRIPTION = 'The current status of the order item.';
    public const LABEL = 'orderItemStatus';
    public const NAME = 'schema:orderItemStatus';
    public const VALUES = ['OrderStatusModel' => 'SchemaOrg\Type\OrderStatusModel'];
    public const TYPES = ['OrderItem' => 'SchemaOrg\Type\OrderItemModel'];
}
