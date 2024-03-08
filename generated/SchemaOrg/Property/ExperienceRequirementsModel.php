<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ExperienceRequirementsModel
{
    public const DESCRIPTION = 'Description of skills and experience needed for the position or Occupation.';
    public const LABEL = 'experienceRequirements';
    public const NAME = 'schema:experienceRequirements';
    public const VALUES = ['OccupationalExperienceRequirementsModel' => 'SchemaOrg\\Type\\OccupationalExperienceRequirementsModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\\Type\\JobPostingModel', 'Occupation' => 'SchemaOrg\\Type\\OccupationModel'];
}
