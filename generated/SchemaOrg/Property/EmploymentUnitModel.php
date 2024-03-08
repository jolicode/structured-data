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

final class EmploymentUnitModel
{
    public const DESCRIPTION = 'Indicates the department, unit and/or facility where the employee reports and/or in which the job is to be performed.';
    public const LABEL = 'employmentUnit';
    public const NAME = 'schema:employmentUnit';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\\Type\\JobPostingModel'];
}
