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

final class WeightModel
{
    public const DESCRIPTION = 'The weight of the product or person.';
    public const LABEL = 'weight';
    public const NAME = 'schema:weight';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['OfferShippingDetails' => 'SchemaOrg\Type\OfferShippingDetailsModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
