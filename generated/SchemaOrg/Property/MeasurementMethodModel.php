<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MeasurementMethodModel
{
    public const DESCRIPTION = 'A subproperty of [[measurementTechnique]] that can be used for specifying specific methods, in particular via [[MeasurementMethodEnum]].';
    public const LABEL = 'measurementMethod';
    public const NAME = 'schema:measurementMethod';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'MeasurementMethodEnumModel' => 'SchemaOrg\Type\MeasurementMethodEnumModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['DataCatalog' => 'SchemaOrg\Type\DataCatalogModel', 'DataDownload' => 'SchemaOrg\Type\DataDownloadModel', 'Dataset' => 'SchemaOrg\Type\DatasetModel', 'Observation' => 'SchemaOrg\Type\ObservationModel', 'PropertyValue' => 'SchemaOrg\Type\PropertyValueModel', 'StatisticalVariable' => 'SchemaOrg\Type\StatisticalVariableModel'];
}
