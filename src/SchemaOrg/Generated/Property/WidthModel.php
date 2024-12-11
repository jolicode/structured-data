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

final class WidthModel
{
    public const DESCRIPTION = 'The width of the item.';
    public const LABEL = 'width';
    public const NAME = 'schema:width';
    public const VALUES = ['DistanceModel' => 'Jolicode\SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
}
