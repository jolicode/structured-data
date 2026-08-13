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

final class HealthcareReportingDataModel
{
    public const DESCRIPTION = 'Indicates data describing a hospital, e.g. a CDC [[CDCPMDRecord]] or as some kind of [[Dataset]].';
    public const LABEL = 'healthcareReportingData';
    public const NAME = 'schema:healthcareReportingData';
    public const VALUES = ['CDCPMDRecordModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CDCPMDRecordModel', 'DatasetModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel'];
    public const TYPES = ['Hospital' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HospitalModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2521'];
    public const SUPERSEDED_BY = null;
}
