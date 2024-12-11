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

final class Percentile90Model
{
    public const DESCRIPTION = 'The 90th percentile value.';
    public const LABEL = 'percentile90';
    public const NAME = 'schema:percentile90';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'Jolicode\SchemaOrg\Type\QuantitativeValueDistributionModel'];
}
