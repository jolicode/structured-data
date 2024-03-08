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

final class MedianModel
{
    public const DESCRIPTION = 'The median value.';
    public const LABEL = 'median';
    public const NAME = 'schema:median';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['QuantitativeValueDistribution' => 'SchemaOrg\\Type\\QuantitativeValueDistributionModel'];
}
