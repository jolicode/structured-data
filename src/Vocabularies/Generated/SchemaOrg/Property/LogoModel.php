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

final class LogoModel
{
    public const DESCRIPTION = 'An associated logo.';
    public const LABEL = 'logo';
    public const NAME = 'schema:logo';
    public const VALUES = ['ImageObjectModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Brand' => 'Jolicode\Vocabularies\SchemaOrg\Type\BrandModel', 'Certification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
