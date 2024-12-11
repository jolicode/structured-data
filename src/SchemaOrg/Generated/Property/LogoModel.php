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

final class LogoModel
{
    public const DESCRIPTION = 'An associated logo.';
    public const LABEL = 'logo';
    public const NAME = 'schema:logo';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Brand' => 'Jolicode\SchemaOrg\Type\BrandModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
}
