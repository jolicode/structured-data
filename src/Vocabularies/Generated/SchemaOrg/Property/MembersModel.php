<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class MembersModel
{
    public const DESCRIPTION = 'A member of this organization.';
    public const LABEL = 'members';
    public const NAME = 'schema:members';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'ProgramMembership' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProgramMembershipModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
