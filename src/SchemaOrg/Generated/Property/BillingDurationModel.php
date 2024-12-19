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

final class BillingDurationModel
{
    public const DESCRIPTION = 'Specifies for how long this price (or price component) will be billed. Can be used, for example, to model the contractual duration of a subscription or payment plan. Type can be either a Duration or a Number (in which case the unit of measurement, for example month, is specified by the unitCode property).';
    public const LABEL = 'billingDuration';
    public const NAME = 'schema:billingDuration';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel', 'NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['UnitPriceSpecification' => 'Jolicode\SchemaOrg\Type\UnitPriceSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
