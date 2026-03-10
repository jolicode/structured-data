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

final class HasMemberProgramModel
{
    public const DESCRIPTION = 'MemberProgram offered by an Organization, for example an eCommerce merchant or an airline.';
    public const LABEL = 'hasMemberProgram';
    public const NAME = 'schema:hasMemberProgram';
    public const VALUES = ['MemberProgramModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MemberProgramModel'];
    public const TYPES = ['Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
