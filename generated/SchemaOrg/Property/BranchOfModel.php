<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class BranchOfModel
{
    public const DESCRIPTION = 'The larger organization that this local business is a branch of, if any. Not to be confused with (anatomical) [[branch]].';
    public const LABEL = 'branchOf';
    public const NAME = 'schema:branchOf';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['LocalBusiness' => 'SchemaOrg\Type\LocalBusinessModel'];
}
