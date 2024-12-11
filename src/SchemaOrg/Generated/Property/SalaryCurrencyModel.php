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

final class SalaryCurrencyModel
{
    public const DESCRIPTION = 'The currency (coded using [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217)) used for the main salary information in this job posting or for this employee.';
    public const LABEL = 'salaryCurrency';
    public const NAME = 'schema:salaryCurrency';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EmployeeRole' => 'Jolicode\SchemaOrg\Type\EmployeeRoleModel', 'JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
}
