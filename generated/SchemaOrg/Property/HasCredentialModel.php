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

final class HasCredentialModel
{
    public const DESCRIPTION = 'A credential awarded to the Person or Organization.';
    public const LABEL = 'hasCredential';
    public const NAME = 'schema:hasCredential';
    public const VALUES = ['EducationalOccupationalCredentialModel' => 'SchemaOrg\Type\EducationalOccupationalCredentialModel'];
    public const TYPES = ['Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel'];
}
