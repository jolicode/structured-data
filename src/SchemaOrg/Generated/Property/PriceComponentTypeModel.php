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

final class PriceComponentTypeModel
{
    public const DESCRIPTION = 'Identifies a price component (for example, a line item on an invoice), part of the total price for an offer.';
    public const LABEL = 'priceComponentType';
    public const NAME = 'schema:priceComponentType';
    public const VALUES = ['PriceComponentTypeEnumerationModel' => 'Jolicode\SchemaOrg\Type\PriceComponentTypeEnumerationModel'];
    public const TYPES = ['UnitPriceSpecification' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
}
