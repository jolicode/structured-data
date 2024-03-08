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

final class CvdNumC19MechVentPatsModel
{
    public const DESCRIPTION = 'numc19mechventpats - HOSPITALIZED and VENTILATED: Patients hospitalized in an NHSN inpatient care location who have suspected or confirmed COVID-19 and are on a mechanical ventilator.';
    public const LABEL = 'cvdNumC19MechVentPats';
    public const NAME = 'schema:cvdNumC19MechVentPats';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\Type\CDCPMDRecordModel'];
}
