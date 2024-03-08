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

final class LogoModel
{
    public const DESCRIPTION = 'An associated logo.';
    public const LABEL = 'logo';
    public const NAME = 'schema:logo';
    public const VALUES = ['ImageObjectModel' => 'SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['Brand' => 'SchemaOrg\Type\BrandModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Place' => 'SchemaOrg\Type\PlaceModel', 'Product' => 'SchemaOrg\Type\ProductModel', 'Service' => 'SchemaOrg\Type\ServiceModel'];
}
