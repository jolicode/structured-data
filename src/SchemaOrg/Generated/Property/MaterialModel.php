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

final class MaterialModel
{
    public const DESCRIPTION = 'A material that something is made from, e.g. leather, wool, cotton, paper.';
    public const LABEL = 'material';
    public const NAME = 'schema:material';
    public const VALUES = ['ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
