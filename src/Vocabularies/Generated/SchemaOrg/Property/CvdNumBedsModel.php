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

final class CvdNumBedsModel
{
    public const DESCRIPTION = 'numbeds - HOSPITAL INPATIENT BEDS: Inpatient beds, including all staffed, licensed, and overflow (surge) beds used for inpatients.';
    public const LABEL = 'cvdNumBeds';
    public const NAME = 'schema:cvdNumBeds';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['CDCPMDRecord' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CDCPMDRecordModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2521'];
    public const SUPERSEDED_BY = null;
}
