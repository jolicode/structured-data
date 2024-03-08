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

final class SubOrganizationModel
{
    public const DESCRIPTION = 'A relationship between two organizations where the first includes the second, e.g., as a subsidiary. See also: the more specific \'department\' property.';
    public const LABEL = 'subOrganization';
    public const NAME = 'schema:subOrganization';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel'];
}
