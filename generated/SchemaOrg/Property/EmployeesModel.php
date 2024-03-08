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

final class EmployeesModel
{
    public const DESCRIPTION = 'People working for this organization.';
    public const LABEL = 'employees';
    public const NAME = 'schema:employees';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
