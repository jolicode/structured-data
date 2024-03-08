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

final class MinValueModel
{
    public const DESCRIPTION = 'The lower value of some characteristic or property.';
    public const LABEL = 'minValue';
    public const NAME = 'schema:minValue';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['MonetaryAmount' => 'SchemaOrg\Type\MonetaryAmountModel', 'PropertyValue' => 'SchemaOrg\Type\PropertyValueModel', 'PropertyValueSpecification' => 'SchemaOrg\Type\PropertyValueSpecificationModel', 'QuantitativeValue' => 'SchemaOrg\Type\QuantitativeValueModel'];
}
