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

final class IsConsumableForModel
{
    public const DESCRIPTION = 'A pointer to another product (or multiple products) for which this product is a consumable.';
    public const LABEL = 'isConsumableFor';
    public const NAME = 'schema:isConsumableFor';
    public const VALUES = ['ProductModel' => 'SchemaOrg\Type\ProductModel'];
    public const TYPES = ['Product' => 'SchemaOrg\Type\ProductModel'];
}
