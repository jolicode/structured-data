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

final class MembershipNumberModel
{
    public const DESCRIPTION = 'A unique identifier for the membership.';
    public const LABEL = 'membershipNumber';
    public const NAME = 'schema:membershipNumber';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ProgramMembership' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProgramMembershipModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
