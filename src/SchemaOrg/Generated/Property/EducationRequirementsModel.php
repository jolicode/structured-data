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

final class EducationRequirementsModel
{
    public const DESCRIPTION = 'Educational background needed for the position or Occupation.';
    public const LABEL = 'educationRequirements';
    public const NAME = 'schema:educationRequirements';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
