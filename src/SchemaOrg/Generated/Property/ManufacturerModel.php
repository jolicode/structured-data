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

final class ManufacturerModel
{
    public const DESCRIPTION = 'The manufacturer of the product.';
    public const LABEL = 'manufacturer';
    public const NAME = 'schema:manufacturer';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
