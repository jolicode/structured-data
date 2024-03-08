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

final class SalaryCurrencyModel
{
    public const DESCRIPTION = 'The currency (coded using [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217)) used for the main salary information in this job posting or for this employee.';
    public const LABEL = 'salaryCurrency';
    public const NAME = 'schema:salaryCurrency';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['EmployeeRole' => 'SchemaOrg\\Type\\EmployeeRoleModel', 'JobPosting' => 'SchemaOrg\\Type\\JobPostingModel'];
}
