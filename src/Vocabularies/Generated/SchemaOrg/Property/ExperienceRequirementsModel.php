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

final class ExperienceRequirementsModel
{
    public const DESCRIPTION = 'Description of skills and experience needed for the position or Occupation.';
    public const LABEL = 'experienceRequirements';
    public const NAME = 'schema:experienceRequirements';
    public const VALUES = ['OccupationalExperienceRequirementsModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OccupationalExperienceRequirementsModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\Vocabularies\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
