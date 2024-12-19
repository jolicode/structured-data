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

final class UnitTextModel
{
    public const DESCRIPTION = 'A string or text indicating the unit of measurement. Useful if you cannot provide a standard unit code for
<a href=\'unitCode\'>unitCode</a>.';
    public const LABEL = 'unitText';
    public const NAME = 'schema:unitText';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValue' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'TypeAndQuantityNode' => 'Jolicode\SchemaOrg\Type\TypeAndQuantityNodeModel', 'UnitPriceSpecification' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
