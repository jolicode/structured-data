<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class Percentile90Model
{
    public const DESCRIPTION = 'The 90th percentile value.';
    public const LABEL = 'percentile90';
    public const NAME = 'schema:percentile90';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'SchemaOrg\\Type\\QuantitativeValueDistributionModel'];
}
