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

final class Percentile10Model
{
    public const DESCRIPTION = 'The 10th percentile value.';
    public const LABEL = 'percentile10';
    public const NAME = 'schema:percentile10';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'Jolicode\SchemaOrg\Type\QuantitativeValueDistributionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
