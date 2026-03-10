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

final class MeasurementQualifierModel
{
    public const DESCRIPTION = 'Provides additional qualification to an observation. For example, a GDP observation measures the Nominal value.';
    public const LABEL = 'measurementQualifier';
    public const NAME = 'schema:measurementQualifier';
    public const VALUES = ['EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\SchemaOrg\Type\ObservationModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
