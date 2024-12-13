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

final class OrderedItemModel
{
    public const DESCRIPTION = 'The item ordered.';
    public const LABEL = 'orderedItem';
    public const NAME = 'schema:orderedItem';
    public const VALUES = ['OrderItemModel' => 'Jolicode\SchemaOrg\Type\OrderItemModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['OrderItem' => 'Jolicode\SchemaOrg\Type\OrderItemModel', 'Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
