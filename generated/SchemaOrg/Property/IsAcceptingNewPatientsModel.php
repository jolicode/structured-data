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

final class IsAcceptingNewPatientsModel
{
    public const DESCRIPTION = 'Whether the provider is accepting new patients.';
    public const LABEL = 'isAcceptingNewPatients';
    public const NAME = 'schema:isAcceptingNewPatients';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['MedicalOrganization' => 'SchemaOrg\Type\MedicalOrganizationModel'];
}
