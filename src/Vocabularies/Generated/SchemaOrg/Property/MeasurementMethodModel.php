<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class MeasurementMethodModel
{
    public const DESCRIPTION = 'A subproperty of [[measurementTechnique]] that can be used for specifying specific methods, in particular via [[MeasurementMethodEnum]].';
    public const LABEL = 'measurementMethod';
    public const NAME = 'schema:measurementMethod';
    public const VALUES = ['DefinedTermModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'MeasurementMethodEnumModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MeasurementMethodEnumModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['DataCatalog' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DataCatalogModel', 'DataDownload' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DataDownloadModel', 'Dataset' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel', 'Observation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ObservationModel', 'PropertyValue' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'StatisticalVariable' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1425'];
    public const SUPERSEDED_BY = null;
}
