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

final class UnitCodeModel
{
    public const DESCRIPTION = 'The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.';
    public const LABEL = 'unitCode';
    public const NAME = 'schema:unitCode';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['PropertyValue' => 'SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'SchemaOrg\Type\QuantitativeValueModel', 'TypeAndQuantityNode' => 'SchemaOrg\Type\TypeAndQuantityNodeModel', 'UnitPriceSpecification' => 'SchemaOrg\Type\UnitPriceSpecificationModel'];
}
