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

final class HasShippingServiceModel
{
    public const DESCRIPTION = 'Specification of a shipping service offered by the organization.';
    public const LABEL = 'hasShippingService';
    public const NAME = 'schema:hasShippingService';
    public const VALUES = ['ShippingServiceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingServiceModel'];
    public const TYPES = ['OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
