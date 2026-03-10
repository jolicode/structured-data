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

final class ShippingOriginModel
{
    public const DESCRIPTION = 'Indicates the origin of a shipment, i.e. where it should be coming from.';
    public const LABEL = 'shippingOrigin';
    public const NAME = 'schema:shippingOrigin';
    public const VALUES = ['DefinedRegionModel' => 'Jolicode\SchemaOrg\Type\DefinedRegionModel'];
    public const TYPES = ['OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel', 'ShippingConditions' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
