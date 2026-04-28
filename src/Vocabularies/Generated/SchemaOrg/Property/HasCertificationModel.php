<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class HasCertificationModel
{
    public const DESCRIPTION = 'Certification information about a product, organization, service, place, or person.';
    public const LABEL = 'hasCertification';
    public const NAME = 'schema:hasCertification';
    public const VALUES = ['CertificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CertificationModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel', 'Place' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
