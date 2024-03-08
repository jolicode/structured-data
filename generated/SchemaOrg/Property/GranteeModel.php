<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class GranteeModel
{
    public const DESCRIPTION = 'The person, organization, contact point, or audience that has been granted this permission.';
    public const LABEL = 'grantee';
    public const NAME = 'schema:grantee';
    public const VALUES = ['AudienceModel' => 'SchemaOrg\\Type\\AudienceModel', 'ContactPointModel' => 'SchemaOrg\\Type\\ContactPointModel', 'OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['DigitalDocumentPermission' => 'SchemaOrg\\Type\\DigitalDocumentPermissionModel'];
}
