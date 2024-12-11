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

final class EmploymentTypeModel
{
    public const DESCRIPTION = 'Type of employment (e.g. full-time, part-time, contract, temporary, seasonal, internship).';
    public const LABEL = 'employmentType';
    public const NAME = 'schema:employmentType';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
}
