<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class OrderItemNumberModel
{
    public const DESCRIPTION = 'The identifier of the order item.';
    public const LABEL = 'orderItemNumber';
    public const NAME = 'schema:orderItemNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['OrderItem' => 'SchemaOrg\\Type\\OrderItemModel'];
}
