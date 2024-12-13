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

final class ValueReferenceModel
{
    public const DESCRIPTION = 'A secondary value that provides additional information on the original value, e.g. a reference temperature or a type of measurement.';
    public const LABEL = 'valueReference';
    public const NAME = 'schema:valueReference';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'EnumerationModel' => 'Jolicode\SchemaOrg\Type\EnumerationModel', 'MeasurementTypeEnumerationModel' => 'Jolicode\SchemaOrg\Type\MeasurementTypeEnumerationModel', 'PropertyValueModel' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel', 'StructuredValueModel' => 'Jolicode\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValue' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'QualitativeValue' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'QuantitativeValue' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
