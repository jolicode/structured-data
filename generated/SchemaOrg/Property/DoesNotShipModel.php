<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class DoesNotShipModel
{
    public const DESCRIPTION = 'Indicates when shipping to a particular [[shippingDestination]] is not available.';
    public const LABEL = 'doesNotShip';
    public const NAME = 'schema:doesNotShip';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['OfferShippingDetails' => 'SchemaOrg\Type\OfferShippingDetailsModel', 'ShippingRateSettings' => 'SchemaOrg\Type\ShippingRateSettingsModel'];
}
