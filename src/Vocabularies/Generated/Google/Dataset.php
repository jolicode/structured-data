<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class Dataset
{
    public const NAME = 'Dataset';
    public const SUPPORTED_TYPES = ['Dataset'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/dataset';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['description' => ['name' => 'description', 'severity' => 'required', 'supportedTypes' => ['Text']], 'name' => ['name' => 'name', 'severity' => 'required', 'supportedTypes' => ['Text']], 'alternateName' => ['name' => 'alternateName', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'creator' => ['name' => 'creator', 'severity' => 'recommended', 'supportedTypes' => ['Person', 'Organization']], 'citation' => ['name' => 'citation', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'CreativeWork']], 'funder' => ['name' => 'funder', 'severity' => 'recommended', 'supportedTypes' => ['Person', 'Organization']], 'hasPart' => ['name' => 'hasPart', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'Dataset']], 'isPartOf' => ['name' => 'isPartOf', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'Dataset']], 'identifier' => ['name' => 'identifier', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'Text', 'PropertyValue']], 'isAccessibleForFree' => ['name' => 'isAccessibleForFree', 'severity' => 'recommended', 'supportedTypes' => ['Boolean']], 'keywords' => ['name' => 'keywords', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'license' => ['name' => 'license', 'severity' => 'recommended', 'supportedTypes' => ['URL', 'CreativeWork']], 'measurementTechnique' => ['name' => 'measurementTechnique', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'sameAs' => ['name' => 'sameAs', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'spatialCoverage' => ['name' => 'spatialCoverage', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'Place']], 'temporalCoverage' => ['name' => 'temporalCoverage', 'severity' => 'recommended', 'supportedTypes' => ['Text']], 'variableMeasured' => ['name' => 'variableMeasured', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'PropertyValue']], 'version' => ['name' => 'version', 'severity' => 'recommended', 'supportedTypes' => ['Text', 'Number']], 'url' => ['name' => 'url', 'severity' => 'recommended', 'supportedTypes' => ['URL']], 'includedInDataCatalog' => ['name' => 'includedInDataCatalog', 'severity' => 'recommended', 'supportedTypes' => ['DataCatalog'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]], 'distribution' => ['name' => 'distribution', 'severity' => 'recommended', 'supportedTypes' => ['DataDownload'], 'properties' => ['contentUrl' => ['name' => 'contentUrl', 'severity' => 'required', 'supportedTypes' => ['URL']], 'encodingFormat' => ['name' => 'encodingFormat', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]]];
}
