<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class BaseSalaryModel
{
    public const DESCRIPTION = 'The base salary of the job or of an employee in an EmployeeRole.';
    public const LABEL = 'baseSalary';
    public const NAME = 'schema:baseSalary';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'PriceSpecificationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['EmployeeRole' => 'Jolicode\Vocabularies\SchemaOrg\Type\EmployeeRoleModel', 'JobPosting' => 'Jolicode\Vocabularies\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
