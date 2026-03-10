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

final class HasOfferCatalogModel
{
    public const DESCRIPTION = 'Indicates an OfferCatalog listing for this Organization, Person, or Service.';
    public const LABEL = 'hasOfferCatalog';
    public const NAME = 'schema:hasOfferCatalog';
    public const VALUES = ['OfferCatalogModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferCatalogModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
