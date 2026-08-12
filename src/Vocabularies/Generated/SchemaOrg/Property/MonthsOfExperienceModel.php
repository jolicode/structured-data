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

final class MonthsOfExperienceModel
{
    public const DESCRIPTION = 'Indicates the minimal number of months of experience required for a position.';
    public const LABEL = 'monthsOfExperience';
    public const NAME = 'schema:monthsOfExperience';
    public const VALUES = ['NumberModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['OccupationalExperienceRequirements' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OccupationalExperienceRequirementsModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2681'];
    public const SUPERSEDED_BY = null;
}
