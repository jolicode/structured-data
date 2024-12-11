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

final class UnitCodeModel
{
    public const DESCRIPTION = 'The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.';
    public const LABEL = 'unitCode';
    public const NAME = 'schema:unitCode';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['PropertyValue' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'TypeAndQuantityNode' => 'Jolicode\SchemaOrg\Type\TypeAndQuantityNodeModel', 'UnitPriceSpecification' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
}
