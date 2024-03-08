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

final class MemberOfModel
{
    public const DESCRIPTION = 'An Organization (or ProgramMembership) to which this Person or Organization belongs.';
    public const LABEL = 'memberOf';
    public const NAME = 'schema:memberOf';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'ProgramMembershipModel' => 'SchemaOrg\\Type\\ProgramMembershipModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Person' => 'SchemaOrg\\Type\\PersonModel'];
}
