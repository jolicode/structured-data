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

final class MonthsOfExperienceModel
{
    public const DESCRIPTION = 'Indicates the minimal number of months of experience required for a position.';
    public const LABEL = 'monthsOfExperience';
    public const NAME = 'schema:monthsOfExperience';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['OccupationalExperienceRequirements' => 'Jolicode\Vocabularies\SchemaOrg\Type\OccupationalExperienceRequirementsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
