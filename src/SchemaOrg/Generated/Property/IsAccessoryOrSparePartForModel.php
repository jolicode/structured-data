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

final class IsAccessoryOrSparePartForModel
{
    public const DESCRIPTION = 'A pointer to another product (or multiple products) for which this product is an accessory or spare part.';
    public const LABEL = 'isAccessoryOrSparePartFor';
    public const NAME = 'schema:isAccessoryOrSparePartFor';
    public const VALUES = ['ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
