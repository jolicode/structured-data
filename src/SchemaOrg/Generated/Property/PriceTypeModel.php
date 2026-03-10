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

final class PriceTypeModel
{
    public const DESCRIPTION = 'Defines the type of a price specified for an offered product, for example a list price, a (temporary) sale price or a manufacturer suggested retail price. If multiple prices are specified for an offer the [[priceType]] property can be used to identify the type of each such specified price. The value of priceType can be specified as a value from enumeration PriceTypeEnumeration or, a UN/EDIFACT 5387 code, or as a free form text string for price types that are not already predefined in PriceTypeEnumeration.';
    public const LABEL = 'priceType';
    public const NAME = 'schema:priceType';
    public const VALUES = ['PriceTypeEnumerationModel' => 'Jolicode\SchemaOrg\Type\PriceTypeEnumerationModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CompoundPriceSpecification' => 'Jolicode\SchemaOrg\Type\CompoundPriceSpecificationModel', 'UnitPriceSpecification' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
