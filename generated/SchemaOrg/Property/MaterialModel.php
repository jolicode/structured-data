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

final class MaterialModel
{
    public const DESCRIPTION = 'A material that something is made from, e.g. leather, wool, cotton, paper.';
    public const LABEL = 'material';
    public const NAME = 'schema:material';
    public const VALUES = ['ProductModel' => 'SchemaOrg\Type\ProductModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
