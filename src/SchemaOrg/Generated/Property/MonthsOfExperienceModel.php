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

final class MonthsOfExperienceModel
{
    public const DESCRIPTION = 'Indicates the minimal number of months of experience required for a position.';
    public const LABEL = 'monthsOfExperience';
    public const NAME = 'schema:monthsOfExperience';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['OccupationalExperienceRequirements' => 'Jolicode\SchemaOrg\Type\OccupationalExperienceRequirementsModel'];
}
