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

final class CvdFacilityIdModel
{
    public const DESCRIPTION = 'Identifier of the NHSN facility that this data record applies to. Use [[cvdFacilityCounty]] to indicate the county. To provide other details, [[healthcareReportingData]] can be used on a [[Hospital]] entry.';
    public const LABEL = 'cvdFacilityId';
    public const NAME = 'schema:cvdFacilityId';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
