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

final class SecurityClearanceRequirementModel
{
    public const DESCRIPTION = 'A description of any security clearance requirements of the job.';
    public const LABEL = 'securityClearanceRequirement';
    public const NAME = 'schema:securityClearanceRequirement';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
