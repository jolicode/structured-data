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

final class MeasurementMethodModel
{
    public const DESCRIPTION = 'A subproperty of [[measurementTechnique]] that can be used for specifying specific methods, in particular via [[MeasurementMethodEnum]].';
    public const LABEL = 'measurementMethod';
    public const NAME = 'schema:measurementMethod';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'MeasurementMethodEnumModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MeasurementMethodEnumModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['DataCatalog' => 'Jolicode\Vocabularies\SchemaOrg\Type\DataCatalogModel', 'DataDownload' => 'Jolicode\Vocabularies\SchemaOrg\Type\DataDownloadModel', 'Dataset' => 'Jolicode\Vocabularies\SchemaOrg\Type\DatasetModel', 'Observation' => 'Jolicode\Vocabularies\SchemaOrg\Type\ObservationModel', 'PropertyValue' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
