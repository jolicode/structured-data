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

final class MemberOfModel
{
    public const DESCRIPTION = 'An Organization (or ProgramMembership) to which this Person or Organization belongs.';
    public const LABEL = 'memberOf';
    public const NAME = 'schema:memberOf';
    public const VALUES = ['MemberProgramTierModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MemberProgramTierModel', 'OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'ProgramMembershipModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProgramMembershipModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
