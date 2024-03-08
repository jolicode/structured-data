<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class QualificationsModel
{
    public const DESCRIPTION = 'Specific qualifications required for this role or Occupation.';
    public const LABEL = 'qualifications';
    public const NAME = 'schema:qualifications';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'SchemaOrg\Type\EducationalOccupationalCredentialModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel', 'Occupation' => 'SchemaOrg\Type\OccupationModel'];
}
