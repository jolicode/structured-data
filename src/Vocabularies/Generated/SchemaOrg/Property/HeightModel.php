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

final class HeightModel
{
    public const DESCRIPTION = 'The height of the item.';
    public const LABEL = 'height';
    public const NAME = 'schema:height';
    public const VALUES = ['DistanceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DistanceModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel', 'OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'ShippingConditions' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingConditionsModel', 'VisualArtwork' => 'Jolicode\Vocabularies\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
