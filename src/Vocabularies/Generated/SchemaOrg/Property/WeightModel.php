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

final class WeightModel
{
    public const DESCRIPTION = 'The weight of the product or person.';
    public const LABEL = 'weight';
    public const NAME = 'schema:weight';
    public const VALUES = ['MassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MassModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['OfferShippingDetails' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferShippingDetailsModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'ShippingConditions' => 'Jolicode\Vocabularies\SchemaOrg\Type\ShippingConditionsModel', 'VisualArtwork' => 'Jolicode\Vocabularies\SchemaOrg\Type\VisualArtworkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
