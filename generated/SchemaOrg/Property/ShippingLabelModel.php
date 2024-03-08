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

final class ShippingLabelModel
{
    public const DESCRIPTION = 'Label to match an [[OfferShippingDetails]] with a [[ShippingRateSettings]] (within the context of a [[shippingSettingsLink]] cross-reference).';
    public const LABEL = 'shippingLabel';
    public const NAME = 'schema:shippingLabel';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['OfferShippingDetails' => 'SchemaOrg\\Type\\OfferShippingDetailsModel', 'ShippingRateSettings' => 'SchemaOrg\\Type\\ShippingRateSettingsModel'];
}
