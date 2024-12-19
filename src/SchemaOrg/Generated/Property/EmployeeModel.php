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

final class EmployeeModel
{
    public const DESCRIPTION = 'Someone working for this organization.';
    public const LABEL = 'employee';
    public const NAME = 'schema:employee';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
