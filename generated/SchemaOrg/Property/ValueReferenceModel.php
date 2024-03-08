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

final class ValueReferenceModel
{
    public const DESCRIPTION = 'A secondary value that provides additional information on the original value, e.g. a reference temperature or a type of measurement.';
    public const LABEL = 'valueReference';
    public const NAME = 'schema:valueReference';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'EnumerationModel' => 'SchemaOrg\\Type\\EnumerationModel', 'MeasurementTypeEnumerationModel' => 'SchemaOrg\\Type\\MeasurementTypeEnumerationModel', 'PropertyValueModel' => 'SchemaOrg\\Type\\PropertyValueModel', 'QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'StructuredValueModel' => 'SchemaOrg\\Type\\StructuredValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['PropertyValue' => 'SchemaOrg\\Type\\PropertyValueModel', 'QualitativeValue' => 'SchemaOrg\\Type\\QualitativeValueModel', 'QuantitativeValue' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
}
