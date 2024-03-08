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

final class MeasurementTechniqueModel
{
    public const DESCRIPTION = 'A technique, method or technology used in an [[Observation]], [[StatisticalVariable]] or [[Dataset]] (or [[DataDownload]], [[DataCatalog]]), corresponding to the method used for measuring the corresponding variable(s) (for datasets, described using [[variableMeasured]]; for [[Observation]], a [[StatisticalVariable]]). Often but not necessarily each [[variableMeasured]] will have an explicit representation as (or mapping to) an property such as those defined in Schema.org, or other RDF vocabularies and "knowledge graphs". In that case the subproperty of [[variableMeasured]] called [[measuredProperty]] is applicable.

The [[measurementTechnique]] property helps when extra clarification is needed about how a [[measuredProperty]] was measured. This is oriented towards scientific and scholarly dataset publication but may have broader applicability; it is not intended as a full representation of measurement, but can often serve as a high level summary for dataset discovery.

For example, if [[variableMeasured]] is: molecule concentration, [[measurementTechnique]] could be: "mass spectrometry" or "nmr spectroscopy" or "colorimetry" or "immunofluorescence". If the [[variableMeasured]] is "depression rating", the [[measurementTechnique]] could be "Zung Scale" or "HAM-D" or "Beck Depression Inventory".

If there are several [[variableMeasured]] properties recorded for some given data object, use a [[PropertyValue]] for each [[variableMeasured]] and attach the corresponding [[measurementTechnique]]. The value can also be from an enumeration, organized as a [[MeasurementMetholdEnumeration]].';
    public const LABEL = 'measurementTechnique';
    public const NAME = 'schema:measurementTechnique';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'MeasurementMethodEnumModel' => 'SchemaOrg\\Type\\MeasurementMethodEnumModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['DataCatalog' => 'SchemaOrg\\Type\\DataCatalogModel', 'DataDownload' => 'SchemaOrg\\Type\\DataDownloadModel', 'Dataset' => 'SchemaOrg\\Type\\DatasetModel', 'Observation' => 'SchemaOrg\\Type\\ObservationModel', 'PropertyValue' => 'SchemaOrg\\Type\\PropertyValueModel', 'StatisticalVariable' => 'SchemaOrg\\Type\\StatisticalVariableModel'];
}
