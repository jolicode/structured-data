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

final class MeasurementQualifierModel
{
    public const DESCRIPTION = 'Provides additional qualification to an observation. For example, a GDP observation measures the Nominal value.';
    public const LABEL = 'measurementQualifier';
    public const NAME = 'schema:measurementQualifier';
    public const VALUES = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ObservationModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2564'];
    public const SUPERSEDED_BY = null;
}
