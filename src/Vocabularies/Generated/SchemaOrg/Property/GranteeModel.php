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

final class GranteeModel
{
    public const DESCRIPTION = 'The person, organization, contact point, or audience that has been granted this permission.';
    public const LABEL = 'grantee';
    public const NAME = 'schema:grantee';
    public const VALUES = ['AudienceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AudienceModel', 'ContactPointModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ContactPointModel', 'OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['DigitalDocumentPermission' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DigitalDocumentPermissionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
