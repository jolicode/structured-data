<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ShippingLabelModel
{
    public const DESCRIPTION = 'Label to match an [[OfferShippingDetails]] with a [[ShippingRateSettings]] (within the context of a [[shippingSettingsLink]] cross-reference).';
    public const LABEL = 'shippingLabel';
    public const NAME = 'schema:shippingLabel';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['OfferShippingDetails' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferShippingDetailsModel', 'ShippingRateSettings' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ShippingRateSettingsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
