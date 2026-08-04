<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class EmploymentUnitModel
{
    public const DESCRIPTION = 'Indicates the department, unit and/or facility where the employee reports and/or in which the job is to be performed.';
    public const LABEL = 'employmentUnit';
    public const NAME = 'schema:employmentUnit';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2296'];
    public const SUPERSEDED_BY = null;
}
