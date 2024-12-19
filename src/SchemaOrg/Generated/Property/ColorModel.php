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

final class ColorModel
{
    public const DESCRIPTION = 'The color of the product.';
    public const LABEL = 'color';
    public const NAME = 'schema:color';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
