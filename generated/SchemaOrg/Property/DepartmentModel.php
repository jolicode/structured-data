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

final class DepartmentModel
{
    public const DESCRIPTION = 'A relationship between an organization and a department of that organization, also described as an organization (allowing different urls, logos, opening hours). For example: a store with a pharmacy, or a bakery with a cafe.';
    public const LABEL = 'department';
    public const NAME = 'schema:department';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
