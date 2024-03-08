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

final class CvdNumBedsModel
{
    public const DESCRIPTION = 'numbeds - HOSPITAL INPATIENT BEDS: Inpatient beds, including all staffed, licensed, and overflow (surge) beds used for inpatients.';
    public const LABEL = 'cvdNumBeds';
    public const NAME = 'schema:cvdNumBeds';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'SchemaOrg\Type\CDCPMDRecordModel'];
}
