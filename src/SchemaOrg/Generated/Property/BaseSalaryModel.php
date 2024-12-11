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

final class BaseSalaryModel
{
    public const DESCRIPTION = 'The base salary of the job or of an employee in an EmployeeRole.';
    public const LABEL = 'baseSalary';
    public const NAME = 'schema:baseSalary';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'PriceSpecificationModel' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['EmployeeRole' => 'Jolicode\SchemaOrg\Type\EmployeeRoleModel', 'JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
}
