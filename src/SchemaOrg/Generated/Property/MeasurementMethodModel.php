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

final class MeasurementMethodModel
{
    public const DESCRIPTION = 'A subproperty of [[measurementTechnique]] that can be used for specifying specific methods, in particular via [[MeasurementMethodEnum]].';
    public const LABEL = 'measurementMethod';
    public const NAME = 'schema:measurementMethod';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'MeasurementMethodEnumModel' => 'Jolicode\SchemaOrg\Type\MeasurementMethodEnumModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['DataCatalog' => 'Jolicode\SchemaOrg\Type\DataCatalogModel', 'DataDownload' => 'Jolicode\SchemaOrg\Type\DataDownloadModel', 'Dataset' => 'Jolicode\SchemaOrg\Type\DatasetModel', 'Observation' => 'Jolicode\SchemaOrg\Type\ObservationModel', 'PropertyValue' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'StatisticalVariable' => 'Jolicode\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
