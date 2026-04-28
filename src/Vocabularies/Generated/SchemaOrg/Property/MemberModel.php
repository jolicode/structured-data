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

final class MemberModel
{
    public const DESCRIPTION = 'A member of an Organization or a ProgramMembership. Organizations can be members of organizations; ProgramMembership is typically for individuals.';
    public const LABEL = 'member';
    public const NAME = 'schema:member';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'ProgramMembership' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProgramMembershipModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
