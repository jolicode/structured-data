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

final class HealthcareReportingDataModel
{
    public const DESCRIPTION = 'Indicates data describing a hospital, e.g. a CDC [[CDCPMDRecord]] or as some kind of [[Dataset]].';
    public const LABEL = 'healthcareReportingData';
    public const NAME = 'schema:healthcareReportingData';
    public const VALUES = ['CDCPMDRecordModel' => 'Jolicode\SchemaOrg\Type\CDCPMDRecordModel', 'DatasetModel' => 'Jolicode\SchemaOrg\Type\DatasetModel'];
    public const TYPES = ['Hospital' => 'Jolicode\SchemaOrg\Type\HospitalModel'];
}
