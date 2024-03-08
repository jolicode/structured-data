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

final class SloganModel
{
    public const DESCRIPTION = 'A slogan or motto associated with the item.';
    public const LABEL = 'slogan';
    public const NAME = 'schema:slogan';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Brand' => 'SchemaOrg\Type\BrandModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Place' => 'SchemaOrg\Type\PlaceModel', 'Product' => 'SchemaOrg\Type\ProductModel', 'Service' => 'SchemaOrg\Type\ServiceModel'];
}
