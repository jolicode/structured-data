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

final class HeightModel
{
    public const DESCRIPTION = 'The height of the item.';
    public const LABEL = 'height';
    public const NAME = 'schema:height';
    public const VALUES = ['DistanceModel' => 'Jolicode\SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'Jolicode\SchemaOrg\Type\OfferShippingDetailsModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'VisualArtwork' => 'Jolicode\SchemaOrg\Type\VisualArtworkModel'];
}
