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

final class WidthModel
{
    public const DESCRIPTION = 'The width of the item.';
    public const LABEL = 'width';
    public const NAME = 'schema:width';
    public const VALUES = ['DistanceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'ShippingConditions' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingConditionsModel', 'VisualArtwork' => 'Jolicode\Vocabularies\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
