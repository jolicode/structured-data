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

final class HostingOrganizationModel
{
    public const DESCRIPTION = 'The Organization (airline, travelers\' club, retailer, etc.) the membership is made with or which offers the  MemberProgram.';
    public const LABEL = 'hostingOrganization';
    public const NAME = 'schema:hostingOrganization';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['MemberProgram' => 'Jolicode\SchemaOrg\Type\MemberProgramModel', 'ProgramMembership' => 'Jolicode\SchemaOrg\Type\ProgramMembershipModel'];
}
