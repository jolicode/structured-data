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

final class NumberedPositionModel
{
    public const DESCRIPTION = 'A number associated with a role in an organization, for example, the number on an athlete\'s jersey.';
    public const LABEL = 'numberedPosition';
    public const NAME = 'schema:numberedPosition';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['OrganizationRole' => 'Jolicode\SchemaOrg\Type\OrganizationRoleModel'];
}
