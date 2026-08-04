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

final class BaseSalaryModel
{
    public const DESCRIPTION = 'The base salary of the job or of an employee in an EmployeeRole.';
    public const LABEL = 'baseSalary';
    public const NAME = 'schema:baseSalary';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'PriceSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['EmployeeRole' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EmployeeRoleModel', 'JobPosting' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
