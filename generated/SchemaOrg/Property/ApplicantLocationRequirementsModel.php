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

final class ApplicantLocationRequirementsModel
{
    public const DESCRIPTION = 'The location(s) applicants can apply from. This is usually used for telecommuting jobs where the applicant does not need to be in a physical office. Note: This should not be used for citizenship or work visa requirements.';
    public const LABEL = 'applicantLocationRequirements';
    public const NAME = 'schema:applicantLocationRequirements';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\\Type\\JobPostingModel'];
}
