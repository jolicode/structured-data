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

final class Percentile25Model
{
    public const DESCRIPTION = 'The 25th percentile value.';
    public const LABEL = 'percentile25';
    public const NAME = 'schema:percentile25';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'SchemaOrg\Type\QuantitativeValueDistributionModel'];
}
