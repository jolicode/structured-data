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

final class BillingIncrementModel
{
    public const DESCRIPTION = 'This property specifies the minimal quantity and rounding increment that will be the basis for the billing. The unit of measurement is specified by the unitCode property.';
    public const LABEL = 'billingIncrement';
    public const NAME = 'schema:billingIncrement';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['UnitPriceSpecification' => 'SchemaOrg\Type\UnitPriceSpecificationModel'];
}
