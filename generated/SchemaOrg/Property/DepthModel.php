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

final class DepthModel
{
    public const DESCRIPTION = 'The depth of the item.';
    public const LABEL = 'depth';
    public const NAME = 'schema:depth';
    public const VALUES = ['DistanceModel' => 'SchemaOrg\\Type\\DistanceModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['OfferShippingDetails' => 'SchemaOrg\\Type\\OfferShippingDetailsModel', 'Product' => 'SchemaOrg\\Type\\ProductModel', 'VisualArtwork' => 'SchemaOrg\\Type\\VisualArtworkModel'];
}
