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

final class IsRelatedToModel
{
    public const DESCRIPTION = 'A pointer to another, somehow related product (or multiple products).';
    public const LABEL = 'isRelatedTo';
    public const NAME = 'schema:isRelatedTo';
    public const VALUES = ['ProductModel' => 'SchemaOrg\Type\ProductModel', 'ServiceModel' => 'SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['Product' => 'SchemaOrg\Type\ProductModel', 'Service' => 'SchemaOrg\Type\ServiceModel'];
}
