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

final class TransitTimeLabelModel
{
    public const DESCRIPTION = 'Label to match an [[OfferShippingDetails]] with a [[DeliveryTimeSettings]] (within the context of a [[shippingSettingsLink]] cross-reference).';
    public const LABEL = 'transitTimeLabel';
    public const NAME = 'schema:transitTimeLabel';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DeliveryTimeSettings' => 'Jolicode\SchemaOrg\Type\DeliveryTimeSettingsModel', 'OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel'];
}
