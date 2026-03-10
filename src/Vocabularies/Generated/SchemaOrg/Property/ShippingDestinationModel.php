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

final class ShippingDestinationModel
{
    public const DESCRIPTION = 'indicates (possibly multiple) shipping destinations. These can be defined in several ways, e.g. postalCode ranges.';
    public const LABEL = 'shippingDestination';
    public const NAME = 'schema:shippingDestination';
    public const VALUES = ['DefinedRegionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedRegionModel'];
    public const TYPES = ['DeliveryTimeSettings' => 'Jolicode\Vocabularies\SchemaOrg\Type\DeliveryTimeSettingsModel', 'OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'ShippingConditions' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingConditionsModel', 'ShippingRateSettings' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
