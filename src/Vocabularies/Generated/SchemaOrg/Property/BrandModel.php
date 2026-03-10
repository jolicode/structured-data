<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BrandModel
{
    public const DESCRIPTION = 'The brand(s) associated with a product or service, or the brand(s) maintained by an organization or business person.';
    public const LABEL = 'brand';
    public const NAME = 'schema:brand';
    public const VALUES = ['BrandModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BrandModel', 'OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
