<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class MeasurementDenominatorModel
{
    public const DESCRIPTION = 'Identifies the denominator variable when an observation represents a ratio or percentage.';
    public const LABEL = 'measurementDenominator';
    public const NAME = 'schema:measurementDenominator';
    public const VALUES = ['StatisticalVariableModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ObservationModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2564'];
    public const SUPERSEDED_BY = null;
}
