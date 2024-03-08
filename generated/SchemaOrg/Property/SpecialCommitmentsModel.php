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

final class SpecialCommitmentsModel
{
    public const DESCRIPTION = 'Any special commitments associated with this job posting. Valid entries include VeteranCommit, MilitarySpouseCommit, etc.';
    public const LABEL = 'specialCommitments';
    public const NAME = 'schema:specialCommitments';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
