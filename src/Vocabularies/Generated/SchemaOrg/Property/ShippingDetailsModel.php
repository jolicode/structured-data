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

final class ShippingDetailsModel
{
    public const DESCRIPTION = 'Indicates information about the shipping policies and options associated with an [[Offer]].';
    public const LABEL = 'shippingDetails';
    public const NAME = 'schema:shippingDetails';
    public const VALUES = ['OfferShippingDetailsModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel'];
    public const TYPES = ['Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
