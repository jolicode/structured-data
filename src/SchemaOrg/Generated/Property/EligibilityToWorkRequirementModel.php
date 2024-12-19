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

final class EligibilityToWorkRequirementModel
{
    public const DESCRIPTION = 'The legal requirements such as citizenship, visa and other documentation required for an applicant to this job.';
    public const LABEL = 'eligibilityToWorkRequirement';
    public const NAME = 'schema:eligibilityToWorkRequirement';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
