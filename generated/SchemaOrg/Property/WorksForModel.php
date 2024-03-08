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

final class WorksForModel
{
    public const DESCRIPTION = 'Organizations that the person works for.';
    public const LABEL = 'worksFor';
    public const NAME = 'schema:worksFor';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Person' => 'SchemaOrg\Type\PersonModel'];
}
