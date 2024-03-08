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

final class OrderDateModel
{
    public const DESCRIPTION = 'Date order was placed.';
    public const LABEL = 'orderDate';
    public const NAME = 'schema:orderDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['Order' => 'SchemaOrg\\Type\\OrderModel'];
}
