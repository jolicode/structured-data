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

final class HasOfferCatalogModel
{
    public const DESCRIPTION = 'Indicates an OfferCatalog listing for this Organization, Person, or Service.';
    public const LABEL = 'hasOfferCatalog';
    public const NAME = 'schema:hasOfferCatalog';
    public const VALUES = ['OfferCatalogModel' => 'Jolicode\SchemaOrg\Type\OfferCatalogModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
}
