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

final class ProgramModel
{
    public const DESCRIPTION = 'The [MemberProgram](https://schema.org/MemberProgram) associated with a [ProgramMembership](https://schema.org/ProgramMembership).';
    public const LABEL = 'program';
    public const NAME = 'schema:program';
    public const VALUES = ['MemberProgramModel' => 'Jolicode\SchemaOrg\Type\MemberProgramModel'];
    public const TYPES = ['ProgramMembership' => 'Jolicode\SchemaOrg\Type\ProgramMembershipModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
