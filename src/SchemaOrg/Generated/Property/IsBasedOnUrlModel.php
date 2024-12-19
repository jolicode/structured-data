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

final class IsBasedOnUrlModel
{
    public const DESCRIPTION = 'A resource that was used in the creation of this resource. This term can be repeated for multiple sources. For example, http://example.com/great-multiplication-intro.html.';
    public const LABEL = 'isBasedOnUrl';
    public const NAME = 'schema:isBasedOnUrl';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
