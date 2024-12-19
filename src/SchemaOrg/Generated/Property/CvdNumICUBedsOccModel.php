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

final class CvdNumICUBedsOccModel
{
    public const DESCRIPTION = 'numicubedsocc - ICU BED OCCUPANCY: Total number of staffed inpatient ICU beds that are occupied.';
    public const LABEL = 'cvdNumICUBedsOcc';
    public const NAME = 'schema:cvdNumICUBedsOcc';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
