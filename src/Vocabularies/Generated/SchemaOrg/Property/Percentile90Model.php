<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class Percentile90Model
{
    public const DESCRIPTION = 'The 90th percentile value.';
    public const LABEL = 'percentile90';
    public const NAME = 'schema:percentile90';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueDistributionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
