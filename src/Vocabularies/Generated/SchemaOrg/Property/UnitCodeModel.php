<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class UnitCodeModel
{
    public const DESCRIPTION = 'The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.';
    public const LABEL = 'unitCode';
    public const NAME = 'schema:unitCode';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['PropertyValue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel', 'TypeAndQuantityNode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TypeAndQuantityNodeModel', 'UnitPriceSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
