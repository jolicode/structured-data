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

final class ValueReferenceModel
{
    public const DESCRIPTION = 'A secondary value that provides additional information on the original value, e.g. a reference temperature or a type of measurement.';
    public const LABEL = 'valueReference';
    public const NAME = 'schema:valueReference';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'EnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EnumerationModel', 'MeasurementTypeEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MeasurementTypeEnumerationModel', 'PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel', 'StructuredValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['PropertyValue' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'QualitativeValue' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'QuantitativeValue' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
