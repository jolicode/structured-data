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

final class MeasurementQualifierModel
{
    public const DESCRIPTION = 'Provides additional qualification to an observation. For example, a GDP observation measures the Nominal value.';
    public const LABEL = 'measurementQualifier';
    public const NAME = 'schema:measurementQualifier';
    public const VALUES = ['EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel'];
    public const TYPES = ['Observation' => 'Jolicode\SchemaOrg\Type\ObservationModel', 'StatisticalVariable' => 'Jolicode\SchemaOrg\Type\StatisticalVariableModel'];
}
