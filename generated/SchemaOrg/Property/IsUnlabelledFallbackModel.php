<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class IsUnlabelledFallbackModel
{
    public const DESCRIPTION = 'This can be marked \'true\' to indicate that some published [[DeliveryTimeSettings]] or [[ShippingRateSettings]] are intended to apply to all [[OfferShippingDetails]] published by the same merchant, when referenced by a [[shippingSettingsLink]] in those settings. It is not meaningful to use a \'true\' value for this property alongside a transitTimeLabel (for [[DeliveryTimeSettings]]) or shippingLabel (for [[ShippingRateSettings]]), since this property is for use with unlabelled settings.';
    public const LABEL = 'isUnlabelledFallback';
    public const NAME = 'schema:isUnlabelledFallback';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['DeliveryTimeSettings' => 'SchemaOrg\\Type\\DeliveryTimeSettingsModel', 'ShippingRateSettings' => 'SchemaOrg\\Type\\ShippingRateSettingsModel'];
}
