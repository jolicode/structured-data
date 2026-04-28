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

final class ReferenceQuantityModel
{
    public const DESCRIPTION = 'The reference quantity for which a certain price applies, e.g. 1 EUR per 4 kWh of electricity. This property is a replacement for unitOfMeasurement for the advanced cases where the price does not relate to a standard unit.';
    public const LABEL = 'referenceQuantity';
    public const NAME = 'schema:referenceQuantity';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['UnitPriceSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
