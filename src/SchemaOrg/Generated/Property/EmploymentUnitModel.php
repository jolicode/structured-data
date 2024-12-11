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

final class EmploymentUnitModel
{
    public const DESCRIPTION = 'Indicates the department, unit and/or facility where the employee reports and/or in which the job is to be performed.';
    public const LABEL = 'employmentUnit';
    public const NAME = 'schema:employmentUnit';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
}
