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

final class IsBasedOnModel
{
    public const DESCRIPTION = 'A resource from which this work is derived or from which it is a modification or adaptation.';
    public const LABEL = 'isBasedOn';
    public const NAME = 'schema:isBasedOn';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'ProductModel' => 'SchemaOrg\Type\ProductModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
