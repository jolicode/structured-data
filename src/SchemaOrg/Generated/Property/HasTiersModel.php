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

final class HasTiersModel
{
    public const DESCRIPTION = 'The tiers of a member program.';
    public const LABEL = 'hasTiers';
    public const NAME = 'schema:hasTiers';
    public const VALUES = ['MemberProgramTierModel' => 'Jolicode\SchemaOrg\Type\MemberProgramTierModel'];
    public const TYPES = ['MemberProgram' => 'Jolicode\SchemaOrg\Type\MemberProgramModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
