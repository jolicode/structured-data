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

final class PermissionTypeModel
{
    public const DESCRIPTION = 'The type of permission granted the person, organization, or audience.';
    public const LABEL = 'permissionType';
    public const NAME = 'schema:permissionType';
    public const VALUES = ['DigitalDocumentPermissionTypeModel' => 'SchemaOrg\Type\DigitalDocumentPermissionTypeModel'];
    public const TYPES = ['DigitalDocumentPermission' => 'SchemaOrg\Type\DigitalDocumentPermissionModel'];
}
