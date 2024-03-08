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

final class HeightModel
{
    public const DESCRIPTION = 'The height of the item.';
    public const LABEL = 'height';
    public const NAME = 'schema:height';
    public const VALUES = ['DistanceModel' => 'SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'SchemaOrg\Type\OfferShippingDetailsModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Product' => 'SchemaOrg\Type\ProductModel', 'VisualArtwork' => 'SchemaOrg\Type\VisualArtworkModel'];
}
