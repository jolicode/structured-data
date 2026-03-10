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

final class ShippingSettingsLinkModel
{
    public const DESCRIPTION = 'Link to a page containing [[ShippingRateSettings]] and [[DeliveryTimeSettings]] details.';
    public const LABEL = 'shippingSettingsLink';
    public const NAME = 'schema:shippingSettingsLink';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
