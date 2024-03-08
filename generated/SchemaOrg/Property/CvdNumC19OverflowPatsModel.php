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

final class CvdNumC19OverflowPatsModel
{
    public const DESCRIPTION = 'numc19overflowpats - ED/OVERFLOW: Patients with suspected or confirmed COVID-19 who are in the ED or any overflow location awaiting an inpatient bed.';
    public const LABEL = 'cvdNumC19OverflowPats';
    public const NAME = 'schema:cvdNumC19OverflowPats';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\Type\CDCPMDRecordModel'];
}
