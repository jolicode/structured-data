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

final class EducationRequirementsModel
{
    public const DESCRIPTION = 'Educational background needed for the position or Occupation.';
    public const LABEL = 'educationRequirements';
    public const NAME = 'schema:educationRequirements';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\Vocabularies\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
