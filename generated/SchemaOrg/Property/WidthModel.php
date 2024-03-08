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

final class WidthModel
{
    public const DESCRIPTION = 'The width of the item.';
    public const LABEL = 'width';
    public const NAME = 'schema:width';
    public const VALUES = ['DistanceModel' => 'SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'SchemaOrg\Type\OfferShippingDetailsModel', 'Product' => 'SchemaOrg\Type\ProductModel', 'VisualArtwork' => 'SchemaOrg\Type\VisualArtworkModel'];
}
