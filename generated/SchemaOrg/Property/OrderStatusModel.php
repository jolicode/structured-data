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

final class OrderStatusModel
{
    public const DESCRIPTION = 'The current status of the order.';
    public const LABEL = 'orderStatus';
    public const NAME = 'schema:orderStatus';
    public const VALUES = ['OrderStatusModel' => 'SchemaOrg\\Type\\OrderStatusModel'];
    public const TYPES = ['Order' => 'SchemaOrg\\Type\\OrderModel'];
}
