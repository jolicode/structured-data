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

final class MaxValueModel
{
    public const DESCRIPTION = 'The upper value of some characteristic or property.';
    public const LABEL = 'maxValue';
    public const NAME = 'schema:maxValue';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['MonetaryAmount' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'PropertyValue' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'PropertyValueSpecification' => 'Jolicode\SchemaOrg\Type\PropertyValueSpecificationModel', 'QuantitativeValue' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
