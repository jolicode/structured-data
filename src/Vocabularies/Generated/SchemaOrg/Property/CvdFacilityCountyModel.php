<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class CvdFacilityCountyModel
{
    public const DESCRIPTION = 'Name of the County of the NHSN facility that this data record applies to. Use [[cvdFacilityId]] to identify the facility. To provide other details, [[healthcareReportingData]] can be used on a [[Hospital]] entry.';
    public const LABEL = 'cvdFacilityCounty';
    public const NAME = 'schema:cvdFacilityCounty';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2521'];
    public const SUPERSEDED_BY = null;
}
