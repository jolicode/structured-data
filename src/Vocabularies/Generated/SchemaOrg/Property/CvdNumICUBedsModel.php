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

final class CvdNumICUBedsModel
{
    public const DESCRIPTION = 'numicubeds - ICU BEDS: Total number of staffed inpatient intensive care unit (ICU) beds.';
    public const LABEL = 'cvdNumICUBeds';
    public const NAME = 'schema:cvdNumICUBeds';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
