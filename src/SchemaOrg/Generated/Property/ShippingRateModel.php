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

final class ShippingRateModel
{
    public const DESCRIPTION = 'The shipping rate is the cost of shipping to the specified destination. Typically, the maxValue and currency values (of the [[MonetaryAmount]]) are most appropriate.';
    public const LABEL = 'shippingRate';
    public const NAME = 'schema:shippingRate';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'ShippingRateSettingsModel' => 'Jolicode\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const TYPES = ['OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel', 'ShippingConditions' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel', 'ShippingRateSettings' => 'Jolicode\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
