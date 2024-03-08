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

final class UnitTextModel
{
    public const DESCRIPTION = 'A string or text indicating the unit of measurement. Useful if you cannot provide a standard unit code for
<a href=\'unitCode\'>unitCode</a>.';
    public const LABEL = 'unitText';
    public const NAME = 'schema:unitText';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValue' => 'SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'SchemaOrg\Type\QuantitativeValueModel', 'TypeAndQuantityNode' => 'SchemaOrg\Type\TypeAndQuantityNodeModel', 'UnitPriceSpecification' => 'SchemaOrg\Type\UnitPriceSpecificationModel'];
}
